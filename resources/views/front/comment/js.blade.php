@section('js')
	<script src="{{ asset('vendor/doT.min.js') }}"></script>
	<script type="text/template" id="template">
    @{{~it:value:index}}
    	<div class="media comm-item items">
			<div class="media-left">
				<img src="@{{=value.user.head_image}}" onerror="javascript:this.src='/images/head.png';" alt="" width="51" height="51">
			</div> 
			<div class="media-body">
				<h5>@{{=value.user.name}}</h5>
				<p class="pub-date">@{{=value.created_at}}</p>
				<p class="comm-text">@{{=value.content}}</p>
				@{{? value.attach.length > 0 }}
					<a class="reply-num" href="javascript:void(0);">
						<span>@{{=value.user_names_arr}}</span>等人 <span class="open-comm">共@{{=value.attach.length}}条回复></span>
					</a>
				@{{?}}
				<div class="comm-reply" style="display: none">
					@{{? value.attach.length > 0 }}
						@{{~value.attach:value2:index2}}
							<div class="media comm-item">
								<div class="media-left">
									<img  src="@{{=value2.user.head_image}}" onerror="this.src='/images/head.png';" alt="" width="51" height="51">
								</div>
								<div class="media-body">
									<h5>@{{=value2.user.name}}</h5>
									<p class="pub-date">@{{=value2.created_at}}</p>
									<p class="comm-text">回复<span style="color:#004796;">@ @{{=value2.replyuser.name}}</span> ： @{{=value2.content}}</p>
								</div>
								<div class="operate">
									<span class="praise" data-id="@{{=value2.id}}" data-more="has">
										<span class="dianzan">@{{=value2.zan}}</span>
										<span class="add-num"><em>+1</em></span>
									</span>
									<a href="javascript:void(0);" data-reply="@{{=value2.user.id}}" data-id="@{{=value.id}}" class="toReply">回复</a>
								</div>
							</div>
						 @{{~}}
					@{{?}}
					<p class="shou"><span>收起</span></p>
				</div>
			</div>
			<div class="operate">
				<span class="praise" data-id="@{{=value.id}}" data-more="nothas">
					<span class="dianzan">@{{=value.zan}}</span>
					<span class="add-num"><em>+1</em></span>
				</span>
				<a href="javascript:void(0);" data-reply="@{{=value.user.id}}" data-id="@{{=value.id}}" class="toReply">回复</a>
			</div>
	   </div>
    @{{~}}
	</script>
	<script type="text/javascript">
		// 存在从评论查看就滚动
		@if(array_key_exists('comment_id', $input))
				if($('#scroll_item').length){
					if($('#scroll_item').parent().hasClass('comm-reply')){
					 	scrollToLocation($('#scroll_item').parent().show());
					}
					else{
						scrollToLocation($('#scroll_item'));
					}
				}
		@endif

		var request_data={user_id:'{!! isset($user->id) ? $user->id : '' !!}'};
		var pub_num=0;
		var request_zan_data = {};

		@if(Request::is('post*'))
			request_data['post_id'] = '{!! $post->id !!}';
			request_zan_data['post_id'] = '{!! $post->id !!}';
		@endif

		//点赞
		$(document).on('click','.praise',function(){
			var num = parseInt($(this).find('span:eq(0)').text());
			var type = '+1';
			var classs = '';
			var that =this;
			//首次点击还是多次点击
			if(!$(this).children('.dianzan').hasClass('dianzans')){
				++num;
				classs = 'dianzans';
			}else{
				--num;
				 request_zan_data['repeat'] = 1;
				 type = '-1';
				 classs = '';
			}
			request_zan_data['comment_id'] = $(this).data('id');
			//折叠的回复
			if($(this).data('more') == 'has'){
				request_zan_data['more_reply'] = 1;
			}
			console.log(request_zan_data);
			$.zcjyRequest('/ajax/publish_zan',function(res){
				if(res){
					//交互动画
					$(that).html("<span class='dianzan "+classs+" animation'>"+num+"</span><span class='add-num add-animation hover'><em>"+type+"</em></span>");
					//重置属性
					delete request_zan_data['repeat'];
					delete request_zan_data['more_reply'];
				}
			},request_zan_data);
		});
		function publish(data,callback=null,reply='',message=''){
			if(!$.empty(reply)){
				data['reply_user_id'] = reply;
			}
			if(!$.empty(message)){
				data['message_id'] = message;
				@if(Request::is('post*'))
					data['comment_id'] = message;
				@endif
			}
			$.zcjyRequest('/ajax/publish_reply',function(res){	
				if(res){
					if(typeof callback === 'function'){
						callback(res);
					}
				}
			},data);
		}
	    $(function(){
	        var show_num = [];
	        draw(show_num);
	        $("#canvas").on('click',function(){
	            draw(show_num);
	        })
	        var user_image=$('.user-head img')[0].src;
	        var user_name='';
	        var now='';
	        var content='';
	        //发布留言
	        $(".fabu").on('click',function(){
	        	if($.empty($('.my-content').val())){
	        		layer.msg('请输入评论内容');
	        		return;
	        	}else if($(".input-code").length==0){
	        		console.log(1);
	        		request_data['content'] = $('.my-content').val();
		        	var that=this;
		        	publish(request_data,function(res){
		        		layer.msg('发布成功！');
		        		$(that).next().remove();
		                $(".my-content").val('');
		        	});
	        	}else{
	        		var val = $(".input-code").val().toLowerCase();
		            var num = show_num.join("");
		            if(val==''){
		                layer.msg('请输入验证码！');
		            }else if(val == num){
			        	request_data['content'] = $('.my-content').val();
			        	var that=this;
			        	publish(request_data,function(res){
			        		location.href=res;
			        	});
		            }else{
		                alert('验证码错误！请重新输入！');
		                $(".input-val").val('');
		                draw(show_num);
		            }
	        	}
	        })
	        //回复留言
	        $(document).on('click','.toReply',function(){
	        	var that = this;
	        	$('.reply-box').remove();
	    		if($(this).parent().siblings('.reply-box').length==0){
	    			$(this).parent().after('<div class="reply-box"><textarea class="form-control" rows="4"></textarea><div class="more"><a href="javacript:void(0);" class="shut">关闭</a><a href="javacript:void(0);" class="immediately-reply" data-reply="'+$(that).data('reply')+'" data-id="'+$(that).data('id')+'">立即回复</a></div></div>')
	    		}
	    	})
	    	$(document).on('click','.shut',function(){
	    		$(this).parent().parent().remove();
	    	})
	       	$(document).on('click','.immediately-reply',function(){
	       		request_data['content']=$(this).parent().prev().val();
	       		console.log(request_data);
	       		console.log($(this).data('reply'));
	       		publish(request_data,function(res){
	       			location.href=res;
	       		},$(this).data('reply'),$(this).data('id'));
	       	});
			//查看更多
			$('.more-comm').click(function(){
				var request_more_data = {skip:$('.items').length};
				var type = 'board';
				@if(Request::is('post*'))
					request_more_data['post_id'] = '{!! $post->id !!}';
					type = 'post';
				@endif
				$.zcjyRequest('/ajax/get_more_messages/'+type,function(res){
					if(res){
						if(res.length == 0){
							$('.more-comm').find('span').text('没有更多的了');
							return;
						}
						// 编译模板函数
		                var tempFn = doT.template( $('#template').html() );
		                // 使用模板函数生成HTML文本
		                var resultHTML = tempFn(res);
		                // 否则，直接替换list中的内容
		                $('.new-commit').append(resultHTML);
					}
		  		},request_more_data);
			});
		});
	    function draw(show_num) {
	        var canvas_width=$('#canvas').width();
	        var canvas_height=$('#canvas').height();
	        var canvas = document.getElementById("canvas");//获取到canvas的对象，演员
	        var context = canvas.getContext("2d");//获取到canvas画图的环境，演员表演的舞台
	        canvas.width = canvas_width;
	        canvas.height = canvas_height;
	        var sCode = "A,B,C,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0";
	        var aCode = sCode.split(",");
	        var aLength = aCode.length;//获取到数组的长度
	        
	        for (var i = 0; i <= 3; i++) {
	            var j = Math.floor(Math.random() * aLength);//获取到随机的索引值
	            var deg = Math.random() * 30 * Math.PI / 180;//产生0~30之间的随机弧度
	            var txt = aCode[j];//得到随机的一个内容
	            show_num[i] = txt.toLowerCase();
	            var x = 10 + i * 20;//文字在canvas上的x坐标
	            var y = 20 + Math.random() * 8;//文字在canvas上的y坐标
	            context.font = "bold 23px 微软雅黑";

	            context.translate(x, y);
	            context.rotate(deg);

	            context.fillStyle = randomColor();
	            context.fillText(txt, 0, 0);

	            context.rotate(-deg);
	            context.translate(-x, -y);
	        }
	        for (var i = 0; i <= 5; i++) { //验证码上显示线条
	            context.strokeStyle = randomColor();
	            context.beginPath();
	            context.moveTo(Math.random() * canvas_width, Math.random() * canvas_height);
	            context.lineTo(Math.random() * canvas_width, Math.random() * canvas_height);
	            context.stroke();
	        }
	        for (var i = 0; i <= 30; i++) { //验证码上显示小点
	            context.strokeStyle = randomColor();
	            context.beginPath();
	            var x = Math.random() * canvas_width;
	            var y = Math.random() * canvas_height;
	            context.moveTo(x, y);
	            context.lineTo(x + 1, y + 1);
	            context.stroke();
	        }
	    }
	    function randomColor() {//得到随机的颜色值
	        var r = Math.floor(Math.random() * 256);
	        var g = Math.floor(Math.random() * 256);
	        var b = Math.floor(Math.random() * 256);
	        return "rgb(" + r + "," + g + "," + b + ")";
	    }
	</script>
	<script type="text/javascript">
		$('.download-now').click(function(){
			  var url = $(this).data('url');
              var save_link = document.createElementNS("http://www.w3.org/1999/xhtml", "a");
             //地址
              save_link.href = url;
              save_link.download = name;
              var ev = document.createEvent("MouseEvents");
              ev.initMouseEvent(
                  "click", true, false, window, 0, 0, 0, 0, 0
                  , false, false, false, false, 0, null
             );
             save_link.dispatchEvent(ev);
   		});
	</script>
@endsection