<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">@lang($model.'/modal.'.$msg_route.'.title')</h4>
</div>
<div class="modal-body">
    @if($error)
        <div>{!! $error !!}</div>
    @else
        @lang($model.'/modal.'.$msg_route.'.body')
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang($model.'/modal.'.$msg_route.'.cancel')</button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-danger">@lang($model.'/modal.'.$msg_route.'.confirm')</a>
  @endif
</div>
