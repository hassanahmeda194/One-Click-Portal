@isset($editNoticeDetail)
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="{{ route('Post.Edit.Notice', ['Notice_ID' => $editNoticeDetail->id]) }}" method="POST"
            enctype="multipart/form-data">

            @csrf
            <div class="modal-body">

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input class="form-control" placeholder="Notice Title" type="text" name="title"
                            value="{{ $editNoticeDetail->title }}">
                    </div>
                     <div class="col-md-6">
                        <label class="form-label">Notice Date</label>
                        <input type="date" class="form-control choose-date flatpickr-input"
                            value="{{ date('Y-m-d', strtotime($editNoticeDetail->created_at)) }}" name="date">
                    </div>
   
                    <div class="d-none" id="notice-type">
                    
                        <label for="notice-type-select" class="form-label">Notice Type</label>
                       <select id="notice-type-select" name="type" class="form-control" readonly>
                        <option disabled>Select Type</option>
                        <option {{ $editNoticeDetail->type == 'description' ? 'selected' : '' }} value="description">Description</option>
                        <option {{ $editNoticeDetail->type == 'image' ? 'selected' : '' }} value="image">Image</option>
                        <option {{ $editNoticeDetail->type == 'video' ? 'selected' : '' }} value="video">Video</option>
                    </select>
                    </div>
                </div>

                @if ($editNoticeDetail->type == 'description')
                    <div class="form-group" id="description">
                        <label class="form-label">Description:</label>
                        <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                @elseif($editNoticeDetail->type == 'video')
                    <div class="form-group" id="Video">
                        <label class="form-label">Upload Video:</label>
                        <input type="file" class="form-control" name="video">
                    </div>
                @elseif($editNoticeDetail->type == 'image')
                    <div class="form-group" id="Image">
                        <label class="form-label">Upload Image:</label>
                        <input type="file" class="form-control" name="image[]" multiple>
                    </div>

                    <div class="form-group row">
                        @foreach ($editNoticeDetail->images as $image)
                            <div class="col-md-3">
                                <div class="mb-2" style="position: relative">
                                    <div>
                                        <img src="{{ asset($image->image) }}" alt="Notice Image"
                                            style="width: 100px; height: auto;">
                                    </div>
                                    <div style="position:absolute; top:4px; right:57px;">
                                        <a href="{{ route('Delete.Notice.Image', ['Notice_ID' => $image->id]) }}" class="">
                                            <i class="fs-4 feather feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>

            </div>
            @endif
            <div class="modal-footer">
                <button type="submit" class="w-100 btn btn-success">Add Notice</button>
        </form>
    </div>
@endisset
