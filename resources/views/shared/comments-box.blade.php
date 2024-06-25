<div class="mx-24 mt-4 mb-16">
    <form action="{{route('comments.store', $movie['slug'])}}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="content" rows="1" class="bg-transparent w-full"></textarea>
        </div>
        @auth
            <div>
                <button type="submit" class="bg-orange-500 mt-2 mb-4 px-4 py-2 rounded">Bình luận</button>
            </div>
        @else
            <a href="{{route('user.dangnhap')}}"><button class="bg-orange-500 mt-2 mb-4 px-4 py-2 rounded">Đăng nhập để bình luận</button></a>
        @endauth
    </form>
    <hr>
    @if (count($comments) > 0)
        @foreach ($comments as $comment)
            <div class="flex items-start mt-2">
                <img style="width: 35px" class="rounded-full mr-2" 
                src="https://img.favpng.com/11/21/25/iron-man-cartoon-avatar-superhero-icon-png-favpng-jrRBMJQjeUwuteGtBce87yMxz.jpg" alt="avatar">
                <div class="w-full">
                    <div class="flex justify-between">
                        <h6>{{$comment['name']}}</h6>
                        <small>{{$comment['created_at']}}</small>
                    </div>
                        <p class="mt-3">
                            {{$comment['content']}}
                        </p>
                </div>
            </div>
        @endforeach
    @else
        <p class="my-4">Chưa có bình luận nào</p>
    @endif
</div>
