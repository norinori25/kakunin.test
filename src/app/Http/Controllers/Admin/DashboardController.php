<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $contacts = $this->filteredContacts($request)->paginate(7);
        $categories = Category::all();

        return view('admin.dashboard', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $query = $this->filteredContacts($request);

        $csvHeader = ['ID', '氏名', 'メール', '性別', 'お問い合わせ種別', '内容', '日付'];

        $response = new StreamedResponse(function () use ($query, $csvHeader) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($query->get() as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->full_name,
                    $contact->email,
                    $contact->gender_label,
                    $contact->category->content ?? '',
                    $contact->detail,
                    $contact->created_at->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', '削除しました');
    }

    public function show($id) 
    {
        $contact = Contact::with('category')->findOrFail($id);

        return response()->json([
            'full_name' => $contact->full_name,
            'email' => $contact->email,
            'gender_label' => $contact->gender_label,
            'category' => $contact->category ? ['content' => $contact->category->content] : null,
            'detail' => $contact->detail,
        ]);
    }

    private function filteredContacts(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('name')) {
            $query->where(DB::raw("CONCAT(last_name, first_name)"), 'like', "%{$request->name}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }
}
