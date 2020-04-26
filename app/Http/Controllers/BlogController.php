<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

   public function index(Request $request)
   {
      $input = $request->all();
      $posts = Post::latest()->paginate(10);

      return view('blog-list')->with(compact('posts'));
   }

   public function show(Post $post)
   {
      // dd($post->toArray()    );

      if (!in_array($post->id, request()->session()->get('viewed_posts') ?? [])) {
         $post->increment('views');
         request()->session()->push('viewed_posts', $post->id);
		}

		$post->load(['comments','author']);

      return view('blog-single')->with(compact('post'));
   }

//    public function loadComments(Request $request)
//    {
//       $faker = Factory::create();
//       $faker->addProvider(new Gravatar($faker));
//       Log::info($request);

//       if ($request->ajax() && $request->postId) {
//          $query = BlogPost::findOrFail($request->postId)->comments()
//             ->where('status', 1);
//          if ($request->lastId && !$request->loadReplies) {
//             $query = $query->whereNull('parent_id')->oldest();
//          } elseif ($request->loadReplies) {
//             $query = $query->whereNotNull('parent_id')->oldest();
//          } else {
//             $query = $query->where(function ($q) {
//                $q->whereNull('parent_id')
//                   ->orWhereHas('parent', function ($qu) {
//                      $qu->where('status', 1);
//                   });
//             })->oldest();
//          };

//          if ($request->lastId) {
//             $lastComment = BlogComment::findOrFail($request->lastId);
//             $query = $query->where('created_at', '>', $lastComment->created_at);
//             // Log::info($query->toSql());
//             // Log::info($query->getBindings());
//             Log::info($request->loadReplies);

//             if ($request->loadReplies && !$lastComment->parent_id) {
//                Log::info('entered');
//                $query = $query->where('parent_id', $lastComment->id);
//             } else {
//                $query = $query->where('parent_id', $lastComment->parent_id);
//             }
//             //TODO: simultaneous comments
//          }

//          $i = 0;
//          $comments = $query->limit(8)
//             ->get()
//             ->map(function ($comment) use ($faker, &$i) {
//                $comment['created_at'] = $comment['created_at'];
//                return collect($comment)
//                   ->except(['sendermail', 'status', 'updated_at'])
//                   ->merge([
//                      'avatar' => $faker->gravatarUrl(),
//                      'hasReply' => $comment->replies()->exists(),
//                      'date_index' => ++$i,
//                      'sort_id' => $comment->parent_id ?? $comment->id,
//                   ]);
//             });

//          $comments = $comments->sort(function ($a, $b) {
//             $n = $a['sort_id'] - $b['sort_id'];
//             return $n != 0 ? $n : $a['date_index'] - $b['date_index'];
//          })->toArray();

//          $LMB = !$request->loadReplies;

//          Log::info(collect($comments)
//             ->map(function ($comment) {
//                return collect($comment)
//                   ->only('id', 'sender', 'parent_id', 'sort_id', 'date_index', 'created_at', 'hasReply');
//             })->toArray());

//          // Log::info($comments);
//       }
//       return view('comments_section')->with(compact('comments', 'LMB'));
//    }

//    public function submitComment(Request $request)
//    {
//       $input = $request->all();
//       Log::info($input);
//       $validator = Validator::make($input, [
//          'sender' => ['required', 'string', 'max:45'],
//          'sendermail' => ['required', 'string', 'email', 'max:45'],
//          'post_id' => ['required', 'integer', 'exists:posts,id'],
//          'body' => ['required', 'string', 'min:5'],
//          'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
//       ])->validate();

//       if ($input['parent_id']) {
//          $parentCm = BlogComment::find($input['parent_id']);
//          if ($parentCm->parent_id) {
//             $input['parent_id'] = $parentCm->parent_id;
//          }
//       }
//       //$validator->validate();
//       // if($validator->fails()){
//       //    Log::info($input['parent_id']);
//       //    Log::info($validator->errors());
//       // }

//       $comment = BlogComment::create($input);
//       Log::info('comment created', $comment->toArray());
//       return response()->json(['success' => 'succ']);
//    }

//    public function contact(Request $request)
//    {
//       $input = $request->all();
//       Log::info($input);

//       $validator = Validator::make($input, [
//          'name' => ['required', 'string', 'max:45'],
//          'email' => ['required', 'string', 'email', 'max:45'],
//          'message' => ['required', 'string', 'min:5'],
//       ])->validate();

//       // Log::info($validator->fails() ? $validator->erros() : 'no erros');

//       $contact = Contact::create($input);
//       if ($contact) {
//          return response()->json(['success' => 'contact submitted']);
//       }
//    }

//    public function subscribe(Request $request)
//    {
//       // dd($request->all());
//       Log::info('email submitted', $request->all());

//       Validator::make($request->all(), [
//          'email' => ['required', 'string', 'email', 'max:45'],
//       ])->validate();

//       $nlmail = MailAdr::create($request->all());
//       if ($nlmail) {
//          return response()->json(['success' => 'email submitted']);
//       }
//    }

//    public function terms()
//    {
//       $post['body'] = Storage::get('terms.txt');
//       $post['title'] = 'شرایط استفاده';
//       return view('about')->with(compact('post'));
//    }
//    public function about()
//    {
//       $post['body'] = Storage::get('about.txt');
//       $post['title'] = 'شرایط استفاده';
//       return view('about')->with(compact('post'));
//    }
}
