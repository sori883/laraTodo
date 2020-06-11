<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="task-view m-auto">
        <ul class="list-group">
            @foreach($tasks as $task)
            <li class="list-group-item">
                <a href="">{{ $task->title }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</main>
