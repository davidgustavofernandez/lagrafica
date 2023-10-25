(function($){
	var initLayout = function() {

		//$('#colorpickerHolder').ColorPicker({flat: true});

		var widt = false;
		
		$('#colorpickerField1').ColorPicker({
			color: '#ff0000',
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorpickerField1').val('#'+hex);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});

		/*$('#dochange').click(function() {
	
			$('body').css('background-color', $('#colorpicker').val());
	
			return false;
		});*/
		
		/*$('#colorSelector').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector div').css('backgroundColor', '#' + hex);
				$('#color').val(hex);
			}
			
		});*/
	};
	
	/*var showTab = function(e) {
		var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
		$(this)
			.addClass('active')
			.blur();
		$('div.tab')
			.hide()
				.eq(tabIndex)
				.show();
	};*/
	
	EYE.register(initLayout, 'init');
})(jQuery)