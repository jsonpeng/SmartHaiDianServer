@section('scripts')
<script type="text/javascript">
	$('.selectDevices').change(function(){
		$('input[name=me]').val($(this).val());
		var that = $('.selectDevices').find("option:selected");
		doChangeIdx(that.attr('supportidx'));
	});
	$('.selectDevices').trigger('change');

	function doChangeIdx(idx)
	{
		 var idxArr = idx.split(',');
		 $('select[name=idx]').find('option').attr('disabled','').each(function(){
			if(in_array($(this).attr('value'),idxArr))
			{
				console.log($(this).attr('value'));
				$(this).removeAttr('disabled');
			}
		});
	}

	function in_array(stringToSearch, arrayToSearch,count_times=false) {
	     var i=0;
	     var status=false;
	     for (s = 0; s < arrayToSearch.length; s++) {
	      thisEntry = arrayToSearch[s];
	      if (thisEntry == stringToSearch) {
	       status=true;
	       i++;
	      }
	     }
	        if(count_times){
	            return i;
	        }
	     return status;
	}
</script>
@endsection