	<div class="commits">
				<div class="commit-myself">
					<div class="comm-limits">
						<span style="color:#008837;">{!! $count !!}</span>条留言 
						@if(!auth('web')->check())
							<a href="javacript:void(0);" class="toLogin" style="margin-left: 12px;">登录</a>
							<span>/</span>
							<a href="javacript:void(0);" class="toRegist">注册</a>
						@endif
					</div>
					<div class="comm-content">
						<div class="media">
							<div class="media-left user-head">
								<img src="{{ isset($user->head_image) ? $user->head_image : '/images/head.png' }}" width="51" height="51" alt="">
							</div>
							<div class="media-body">
								<textarea class="form-control my-content" maxlength="190" rows="4"></textarea>
							</div>
						</div>
					</div>
					<div class="more">
						<a href="javacript:void(0);" class="fabu hidden-xs">立即发布</a>
						<span>
							<input type="text" class="form-control input-code" placeholder="输入验证码">
							<canvas id="canvas" width="100" height="34">您的浏览器不支持canvas，请换个浏览器试试~</canvas>
						</span>	
						<div class="visible-xs" style="padding:15px 0;">
							<a href="javacript:void(0);" class="fabu ">立即发布</a>
						</div>	
					</div>
				</div>
				@if(count($messages))
					<div class="new-commit">
						<p class="title">最新留言</p>
						@foreach ($messages as $message)
							<div class="media comm-item items" @if(isset($message['active'])) id="scroll_item" @endif> 
								<div class="media-left">
									<img src="{{  $message['user']->head_image }}" onerror="javascript:this.src='/images/head.png';" alt="" width="51" height="51">
								</div> 
								<div class="media-body">
									<h5>{!! $message['user']->name !!}</h5>
									<p class="pub-date">{!! $message->created_at !!}</p>
									<p class="comm-text">{!! $message->content !!}</p>
									@if(count($message['attach']) > 0)
										<a class="reply-num" href="javascript:void(0);">
											<span>{!! $message['user_names_arr'] !!}</span>等人 <span class="open-comm">共{!! count($message['attach']) !!}条回复></span>
										</a>
									@endif
									<div class="comm-reply" style="display: none">
										@if(count($message['attach']) >0)
											@foreach($message['attach'] as $item)
												<div class="media comm-item" @if(isset($item['active'])) id="scroll_item" @endif>
													<div class="media-left">
														<img  src="{!! $item['user']->head_image !!}" onerror="this.src='/images/head.png';" alt="" width="51" height="51">
													</div>
													<div class="media-body">
														<h5>{!! $item['user']->name !!}</h5>
														<p class="pub-date">{!! $item->created_at !!}</p>
														<p class="comm-text">回复<span style="color:#004796;">@ {!! $item['replyuser']->name !!}</span> ： {!! $item->content !!}</p>
													</div>
													<div class="operate">
														<span class="praise" data-id="{!! $item->id !!}" data-more="has">
															<span class="dianzan">{!! $item->zan !!}</span>
															<span class="add-num"><em>+1</em></span>
														</span>
														<a href="javascript:void(0);" data-reply="{{ $item['user']->id }}" data-id="{{ $message->id }}" class="toReply">回复</a>
													</div>
												</div>
											@endforeach
										@endif
										<p class="shou"><span>收起</span></p>
									</div>
								</div>
								<div class="operate">
									<span class="praise" data-id="{!! $message->id !!}" data-more="nothas">
										<span class="dianzan">{!! $message->zan !!}</span>
										<span class="add-num"><em>+1</em></span>
									</span>
									<a href="javascript:void(0);" data-reply="{{ $message['user']->id }}" data-id="{{ $message->id }}" class="toReply">回复</a>
								</div>
							</div>
					  @endforeach
					</div>
					@if(count($messages) == 20 && !array_key_exists('comment_id',$input))
						<div class="more-comm">
							<span>查看更多留言</span>
						</div>
					@endif
				@endif
	</div>