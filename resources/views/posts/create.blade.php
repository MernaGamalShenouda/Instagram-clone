<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/posts/post-create.css') }}">
    {{-- <button type="button" class="btn btn-primary mt-5" data-bs-toggle="collapse" data-bs-target="#card">
        View Post
    </button> --}}

    <div class="container-fluid row justify-content-center align-items-center">
        <div class="row justify-content-center col-11">
            <div class="col-md-5">
                <div class="card">
                    <h6 class="mx-auto pt-2 font-weight-bold create-post-text">Create new post</h6>
                    <hr class="p-0 m-0 transparent">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg aria-label="Icon to represent media such as images or videos"
                            class="mb-3" fill="currentColor" height="77" role="img"
                            viewBox="0 0 97.6 77.3" width="96">
                            <title>Icon to represent media such as images or videos</title>
                            <path
                                d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z"
                                fill="currentColor"></path>
                            <path
                                d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z"
                                fill="currentColor"></path>
                            <path
                                d="M78.2 41.6 61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z"
                                fill="currentColor"></path>
                        </svg>
                        <p class="photos-text">Drag photos and videos here</p>
                         <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" class="form-control d-none" id="images" name="images[]"
                                    accept="image/*" multiple required>
                                    <label for="images" class="btn btn-primary">Select from computer</label>
                            </div>
                            <div class="mb-3 " id="captionAndShare">
                                <label for="content" class="form-label">Caption</label>
                                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Write a caption..." required></textarea>
                                <div id="tagSuggestions" class="dropdown">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    </ul>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary "
                                id="shareButton">Share</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/posts/post-create.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).on('click', '.tag-suggestion', function() {
                let suggestedTag = $(this).text();
                let content = $('#content').val();
                let cursorPosition = $('#content')[0].selectionStart;
                let tagStart = content.lastIndexOf('#', cursorPosition - 1);
                let newText = content.substring(0, tagStart + 1) + suggestedTag.substring(1) + ' ' + content.substring(
                    cursorPosition);
                $('#content').val(newText);
                $('#tagSuggestions ul').removeClass('show');
                $('#content').focus();
            });

            $('#content').on('input', function() {
                let content = $(this).val();
                let cursorPosition = $(this)[0].selectionStart;
                let tagStart = content.lastIndexOf('#', cursorPosition - 1);

                if (tagStart !== -1 && event.keyCode != 32) {
                    let tag = content.substring(tagStart + 1, cursorPosition);
                    if (tag.trim() !== '') {
                        $.ajax({
                            url: '{{ route('tags.suggest') }}',
                            type: 'GET',
                            data: {
                                tag: tag.trim()
                            },
                            success: function(response) {
                                let dropdownMenu = $('#tagSuggestions ul');
                                dropdownMenu.empty();
                                if (response.length > 0) {
                                    response.forEach(function(tag) {
                                        dropdownMenu.append(
                                            '<li class="dropdown-item tag-suggestion cursor-pointer">#' +
                                            tag
                                            .name + '</li>'
                                        );
                                    });
                                    $('#tagSuggestions ul').addClass('show');
                                } else {
                                    $('#tagSuggestions ul').removeClass('show');
                                }
                            },

                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        $('#tagSuggestions ul').empty();
                        $('#tagSuggestions ul').removeClass('show');
                    }
                } else {
                    $('#tagSuggestions ul').empty();
                    $('#tagSuggestions ul').removeClass('show');
                }
            });

            $('#images').on('change', function() {
                $('#captionAndShare').removeClass('d-none');
                $('#shareButton').removeClass('d-none');
            });
        </script>
    @endpush
</x-app-layout>
