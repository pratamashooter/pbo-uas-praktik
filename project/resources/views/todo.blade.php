<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white text-dark">
    <div class="container grid grid-cols-1 lg:grid-cols-2 mx-auto lg:pt-12">
        <div class="pt-8 px-8 mb-8">
            <img src="{{ asset('assets/bg/bg-1.gif') }}" alt="Gif Animation"
                class="w-full aspect-auto[16/10] object-cover select-none mb-6" />
            <audio id="music-player" class="hidden" controls loop>
                <source src="{{ asset('assets/music/lofi-1.mp3') }}" type="audio/mpeg" />
                Your browser does not support the audio element.
            </audio>
            <div class="flex items-center">
                <button type="button" class="flex items-center h-12 px-5 rounded bg-primary font-medium mr-4"
                    id="toggle-music-button" data-pause="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-play mr-3">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    Play Music
                </button>
            </div>
        </div>
        <div class="pt-8 px-8 mb-8">
            <h1 class="text-5xl font-bold mb-4">Track Your Journey</h1>
            <p class="leading-7">
                Ut animi voluptas. Ullam delectus est velit sint accusamus reiciendis dolores sed. Necessitatibus iusto
                impedit sint vitae quos deleniti autem dolores.
            </p>
            <form action="{{ route('create') }}" method="post" class="mt-5">
                @csrf
                <input type="text" name="task"
                    class="border-2 border-solid border-dark rounded placeholder:text-dark/50 h-14 w-full py-0 px-5 mb-4 focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Add your new todo" />
                <button type="submit" class="font-medium bg-primary rounded h-14 w-full hover:bg-primary/80">
                    Create New Todo
                </button>
            </form>
            <div class="mt-12">
                @foreach ($data as $todo)
                    <form action="{{ route('checked', $todo->id) }}" method="post"
                        class="flex items-center border-2 border-solid border-dark rounded cursor-pointer select-none h-14 pl-5 pr-2 mb-4 hover:bg-warning">
                        @csrf

                        <input type="hidden" name="checked" value="{{ $todo->is_checked ? 0 : 1 }}">
                        @if ($todo->is_checked)
                            <button
                                type="submit" class="inline-block w-[1.25rem] min-w-[1.25rem] max-w-[1.25rem] h-[1.25rem] min-h-[1.25rem] max-h-[1.25rem] border-2 border-solid border-dark bg-dark rounded-full">
                            </button>
                        @else
                            <button
                                type="submit" class="inline-block w-[1.25rem] min-w-[1.25rem] max-w-[1.25rem] h-[1.25rem] min-h-[1.25rem] max-h-[1.25rem] border-2 border-solid border-dark bg-white rounded-full">
                            </button>
                        @endif

                        <div class="grow text-ellipsis whitespace-nowrap overflow-hidden mx-4">
                            @if ($todo->is_checked)
                                <span
                                    class="relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:w-full before:border-t-2 before:border-solid before:border-dark">
                                    {{ $todo->task }}
                                </span>
                            @else
                                <span class="relative"> {{ $todo->task }} </span>
                            @endif
                        </div>
                        <a href="{{ route('delete', $todo->id) }}"
                            class="inline-flex items-center justify-center rounded-full w-10 min-w-[2.5rem] max-w-[2.5rem] h-10 min-h-[2.5rem] max-h-[2.5rem] hover:bg-dark/5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trash-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </a>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const musicPlayer = document.getElementById("music-player");
            const toggleMusicButton = document.getElementById("toggle-music-button");

            toggleMusicButton.addEventListener("click", function() {
                const isPause = toggleMusicButton.dataset.pause === "true";
                if (isPause) {
                    musicPlayer.play();
                    toggleMusicButton.innerHTML = `
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-play mr-3"
              >
                <rect x="6" y="4" width="4" height="16"></rect>
                <rect x="14" y="4" width="4" height="16"></rect>
              </svg> Stop Music
          `;
                } else {
                    musicPlayer.pause();
                    toggleMusicButton.innerHTML = `
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-play mr-3"
              >
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
              </svg> Play Music
          `;
                }
                toggleMusicButton.dataset.pause = !isPause;
            });
        });
    </script>
</body>

</html>