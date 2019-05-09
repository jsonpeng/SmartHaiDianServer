@section('scripts')
<script type="text/javascript">
	$('select[name=time_span]').change(function(){
		var val = parseInt($(this).val());
		if(val == 0)
		{
			$('.record_time').show();
			$('.record_date').hide();
			$('#record_date').val('');
		}
		else{
			$('.record_time').hide();
			$('#record_time').val('');
			$('.record_date').show();
		}
	});
	$('select[name=time_span]').trigger('change');

   $('#record_date').datepicker({
        format: "yyyy-mm-dd",
        language: "zh-CN",
        todayHighlight: true,
        autoclose: true
    });

   // $('#record_time').datepicker({
	 	//  format: "yyyy-mm-dd hh",
		 // language: "zh-CN",
		 // todayHighlight: true,
	  //    autoclose: true
   //  });
   	$('#record_time').datetimepicker({
        language: 'zh-CN',
		weekStart: 0,
		todayBtn: true,
		autoclose: true,
		todayHighlight: true,
		startView: 2,
		minView: 1,
		forceParse: 0,
		format:'yyyy-mm-dd hh:00',
		clearBtn:true,
        minuteStep: 10,
    });
</script>
@endsection