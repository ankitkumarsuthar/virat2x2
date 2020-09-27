<div class="card-box">

    <p class="text-muted font-14 m-b-20">
        &nbsp;
    </p>

   {{ Form::open(['route' => ['admin.notification.store'], 'class' => 'kt-form kt-form--label-left', 'name' => 'notification_form', 'id' => 'notification_form' ]) }}   

        <div class="form-group row">
            <label for="title" class="col-2 col-form-label">Add Notification<span class="text-danger">*</span></label>
            <div class="col-4">
                <input id="title" placeholder="Notification Title" name="title" type="text"  class="form-control">
            </div>
            <div class="col-6">
                <input id="details" placeholder="Notification Details" name="details" type="text"  class="form-control">
            </div>

        </div>
        <div class="form-group row">
            <div class="col-8 offset-2">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    Add New Notification
                </button>

            </div>
        </div>
    {{ Form::close() }}
</div> <!-- end card-box -->