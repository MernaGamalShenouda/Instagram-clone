<x-app-layout>
    <div class="container py-12">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="images" class="form-label">Choose Image(s)</label>
                                <input type="file" class="form-control" id="images" name="images[]"
                                    accept="image/*" multiple required>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Caption</label>
                                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Write a caption..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Share</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
