<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/posts/post-create.css') }}">
    <button type="button" class="btn btn-primary mt-5" id="viewButton">
        Add new post
    </button>

    <div class="container-fluid row justify-content-center align-items-center d-none" id="mainParent">
        <div class="row justify-content-center col-11">
            <div class="col-5" id="widthChangingDiv">
                <div class="card">
                    <button class="btn p-0 m-0 back-arrow-button d-none" id="backArrowButton">
                        <img src="{{ asset('images/posts/arrow.png') }}" class="arrow-img">
                    </button>
                    <h6 class="mx-auto pt-2 font-weight-bold create-post-text">Create new post</h6>

                    <button class="btn p-0 pt-1 m-0" id="closeButton">X
                    </button>
                    <hr class="p-0 m-0 transparent">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                            class="row d-flex  justify-content-center align-items-center w-100 h-100">
                            <div
                                class="images-handeling col-8 d-flex justify-content-center align-items-center flex-column">
                                <svg aria-label="Icon to represent media such as images or videos" class="mb-3"
                                    id="svgIcon" fill="currentColor" height="77" role="img"
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
                                <p class="photos-text" id="photosText">Drag photos and videos here</p>
                                @csrf
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <input type="file" class="form-control d-none" id="images" name="images[]"
                                        accept="image/*" multiple required>
                                    <label for="images" class="btn btn-primary" id="selectButton">Select from
                                        computer</label>
                                </div>
                                <div id="selectedImages" class="carousel slide" data-bs-interval="false">
                                    <div class="carousel-inner"></div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#selectedImages" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#selectedImages" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 col-4 border-left h-100 p-0 m-0 d-none" id="captionAndShare">
                                <div class="col-md-6 d-flex flex-column justify-content-between align-items-start">

                                    <div class="col-md-3 p-0 m-0 post-userInfo-section">
                                        <div class="post-userInfo-content">
                                            <img src="{{ $user->avatar }}" class="img-fluid rounded avatar-image"
                                                alt="User Avatar">
                                            <div>
                                                <p class="username"><strong>{{ $user->username }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="textareaDropdown">
                                    <div style="position: relative;">
                                        <div class="textareaDropdown">
                                            <div style="position: relative;">
                                                <textarea id="content" class="w-100 mt-2 border-0 border-bottom m-0 form-control transparent-50" name="content"
                                                    rows="9" required placeholder="Write a caption..." maxlength="2200"></textarea>
                                                <div id="character-counter" class="text-end mt-2 text-muted"
                                                    style="position: absolute; bottom: 5px; right: 5px; font-size: 10px; opacity:0.6;">
                                                    0 / 2200
                                                </div>
                                            </div>
                                            <div class="dropdown" style="position: absolute; bottom: 5px; left: 5px;">
                                                <button class="btn" type="button" id="dropdownStickers"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg aria-label="Emoji" class="x1lliihq x1n2onr6 x1roi4f4"
                                                        fill="currentColor" height="20" role="img"
                                                        viewBox="0 0 24 24" width="20">
                                                        <title>Emoji</title>
                                                        <path
                                                            d="M15.83 10.997a1.167 1.167 0 1 0 1.167 1.167 1.167 1.167 0 0 0-1.167-1.167Zm-6.5 1.167a1.167 1.167 0 1 0-1.166 1.167 1.167 1.167 0 0 0 1.166-1.167Zm5.163 3.24a3.406 3.406 0 0 1-4.982.007 1 1 0 1 0-1.557 1.256 5.397 5.397 0 0 0 8.09 0 1 1 0 0 0-1.55-1.263ZM12 .503a11.5 11.5 0 1 0 11.5 11.5A11.513 11.513 0 0 0 12 .503Zm0 21a9.5 9.5 0 1 1 9.5-9.5 9.51 9.51 0 0 1-9.5 9.5Z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-start "
                                                    aria-labelledby="dropdownStickers">
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😊</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">❤️</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">👍</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😂</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😍</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😎</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">🤩</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😘</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">🥰</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😋</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😜</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😇</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">🤗</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😉</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😚</a>
                                                    </li>
                                                    <li class="col-1 emoji" style="display: inline-block;"><a
                                                            class="text-decoration-none sticker" href="#">😛</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mt-3"
                                        id="shareButton">Share</button>

                                    <div id="tagSuggestions" class="dropdown">
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        </ul>
                                    </div>
                                </div>

                            </div>

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
        <script src=""></script>
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
            $(document).ready(function() {
                $('#content').on('input', function() {
                    var maxLength = 2200;
                    var length = $(this).val().length;
                    var remainingCharacters = maxLength - length;
                    $('#character-counter').text(length + ' / ' + maxLength);
                });
            });

            $('#content').on('keydown', function() {
                let content = $(this).val();
                let cursorPosition = $(this)[0].selectionStart;
                let tagStart = content.lastIndexOf('#', cursorPosition - 1);

                if (tagStart !== -1 && event.keyCode != 32) {
                    let tag = content.substring(tagStart + 1, cursorPosition);
                    if (tag.trim() !== '') {
                        $.ajax({
                            url: '{{ route("tags.suggest") }}',
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
                var carouselInner = $('#selectedImages .carousel-inner');
                carouselInner.empty();

                var images = this.files;
                console.log(images);
                if (images && images.length > 0) {
                    for (var i = 0; i < images.length; i++) {
                        (function(index) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var imageSrc = e.target.result;
                                var carouselItemClass = (index === 0) ? 'carousel-item active w-100 h-100' :
                                    'carousel-item';
                                var imgHtml = '<div class="' + carouselItemClass + '">' +
                                    '<img src="' + imageSrc +
                                    '" class="d-block w-100 h-100 img-fluid" alt="Image">' +
                                    '</div>';
                                carouselInner.append(imgHtml);
                            };
                            reader.readAsDataURL(images[index]);
                        })(i);
                    }

                    if (images.length > 1) {
                        $('#selectedImages .carousel-control-prev').show();
                        $('#selectedImages .carousel-control-next').show();
                    } else {
                        $('#selectedImages .carousel-control-prev').hide();
                        $('#selectedImages .carousel-control-next').hide();
                    }

                    $('#selectButton').addClass('d-none');
                    $('#photosText').addClass('d-none');
                    $('#svgIcon').addClass('d-none');
                    $('#backArrowButton').removeClass('d-none');
                    $('#selectedImages').removeClass('d-none');
                    $('#shareButton').removeClass('d-none');
                    $('#widthChangingDiv').addClass('col-7');
                    $('#widthChangingDiv').removeClass('col-5');
                    $('#captionAndShare').removeClass('d-none');
                } else {
                    $('#selectedImages').removeClass('d-none');
                    $('#selectedImages .carousel-control-prev').hide();
                    $('#selectedImages .carousel-control-next').hide();
                    $('#selectButton').removeClass('d-none');
                    $('#photosText').removeClass('d-none');
                    $('#svgIcon').removeClass('d-none');
                    $('#backArrowButton').addClass('d-none');
                    $('#shareButton').addClass('d-none');
                    $('#widthChangingDiv').removeClass('col-7');
                    $('#widthChangingDiv').addClass('col-5');
                    $('#captionAndShare').addClass('d-none');
                }
            });
            $('#backArrowButton').on('click', function() {
                $('#shareButton').addClass('d-none');
                $('#selectButton').removeClass('d-none');
                $('#photosText').removeClass('d-none');
                $('#svgIcon').removeClass('d-none');
                $('#backArrowButton').addClass('d-none');
                $('#selectedImages').addClass('d-none');
                $('#widthChangingDiv').removeClass('col-7');
                $('#widthChangingDiv').addClass('col-5');
                $('#captionAndShare').addClass('d-none');
                $images = this.files = [];
            });
            document.addEventListener("DOMContentLoaded", function() {
                var textarea = document.getElementById("content");

                var stickers = document.querySelectorAll(".sticker");

                stickers.forEach(function(sticker) {
                    sticker.addEventListener("click", function(event) {
                        event.preventDefault();

                        var currentValue = textarea.value;

                        var stickerText = sticker.textContent;

                        if (currentValue.indexOf(stickerText) === -1) {
                            var cursorPosition = textarea.selectionStart;

                            if (!isWithinWord(currentValue, cursorPosition)) {
                                if (currentValue.charAt(cursorPosition - 1) !== " ") {
                                    currentValue = currentValue.substring(0, cursorPosition) + " " +
                                        currentValue.substring(cursorPosition);
                                    cursorPosition++;
                                }

                                var newValue =
                                    currentValue.substring(0, cursorPosition) +
                                    stickerText +
                                    currentValue.substring(cursorPosition);

                                textarea.value = newValue;

                                textarea.selectionStart = cursorPosition + stickerText.length;
                                textarea.selectionEnd = cursorPosition + stickerText.length;

                                textarea.dispatchEvent(new Event('input'));
                                $('#content').focus();
                            }
                        }
                    });
                });

                function isWithinWord(text, position) {
                    return /\S/.test(text.charAt(position - 1)) && /\S/.test(text.charAt(position));
                }
            });

            $('#viewButton').on('click', function() {
                $('#mainParent').removeClass('d-none');
                $('#viewButton').addClass('d-none');
            });
            $('#closeButton').on('click', function() {
                $('#mainParent').addClass('d-none');
                $('#viewButton').removeClass('d-none');
            });
        </script>
    @endpush
</x-app-layout>
