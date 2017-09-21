@if ($target_user->id != auth()->id())
<div>
	@if (auth()->user()->hasStar($target_user->id))
	<button class="btn btn-default follow-button" follow-value="1" follow-user="{{$target_user->id}}" type="button">取消关注</button>
	@else
	<button class="btn btn-default follow-button" follow-value="0" follow-user="{{$target_user->id}}" type="button">关注</button>
	@endif
</div>
@endif