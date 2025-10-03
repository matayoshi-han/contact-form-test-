<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;

class AdominController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Contact::with('category')->latest();

        // 検索条件の適用
        $query->when($request->name, function (Builder $query, $name) {
            return $query->where(function (Builder $q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                    ->orWhere('last_name', 'like', "%{$name}%");
            });
        });

        $query->when($request->email, function (Builder $query, $email) {
            return $query->where('email', 'like', "%{$email}%");
        });

        $query->when($request->gender, function (Builder $query, $gender) {
            // 性別が「全て」でない場合のみ適用
            if ($gender !== 'all') {
                return $query->where('gender', $gender);
            }
        });

        $query->when($request->category_id, function (Builder $query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });

        $query->when($request->date_from, function (Builder $query, $date) {
            return $query->whereDate('created_at', '>=', $date);
        });

        $query->when($request->date_to, function (Builder $query, $date) {
            return $query->whereDate('created_at', '<=', $date);
        });

        $contacts = $query->paginate(7)->appends($request->except('page'));

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('status', 'データを削除しました。');
    }

    public function export(Request $request)
    {
        $query = Contact::with('category')->latest();

        // 検索条件の適用（indexメソッドと同じロジック）
        $query->when($request->name, function (Builder $query, $name) {
            return $query->where(function (Builder $q) use ($name) {
                $q->where('first_name', 'like', "%{$name}%")
                    ->orWhere('last_name', 'like', "%{$name}%");
            });
        });
        // ... 他の検索条件を同様に適用 ...

        $contacts = $query->get();

        $csvData = $contacts->map(function ($contact) {
            return [
                'ID' => $contact->id,
                '名前' => $contact->first_name . ' ' . $contact->last_name,
                'メールアドレス' => $contact->email,
                '性別' => $this->getGenderText($contact->gender),
                'カテゴリー' => optional($contact->category)->content,
                '登録日時' => $contact->created_at->format('Y-m-d H:i:s'),
            ];
        });

        $headers = ['ID', '名前', 'メールアドレス', '性別', 'カテゴリー', '登録日時'];

        $csv = \League\Csv\Writer::createFromString('');
        $csv->setDelimiter(',');
        $csv->insertAll(array_merge([$headers], $csvData->toArray()));

        return Response::streamDownload(function () use ($csv) {
            echo $csv->getContent();
        }, 'contacts.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function getGenderText($gender)
    {
        switch ($gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '不明';
        }
    }
}
