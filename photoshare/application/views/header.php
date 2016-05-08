(function($) {
	//Create our accordions
	$( "#cptui_accordion" ).accordion({ collapsible: true, heightStyle: 'fill', active: 2 });

	//confirm our deletions
	$( '#cpt_submit_delete' ).on( 'click', function() {
		if( confirm( confirmdata.confirm ) ) {
			return true;
		}
		return false;
	});

	$('#support .question').each(function() {
		var tis = $(this), state = false, answer = tis.next('div').slideUp();
		tis.click(function() {
			state = !state;
			answer.slideToggle(state);
			tis.toggleClass('active',state);
		});
	});

	var orig, highlight;
	$('#cptui_accordion h3').hover(function(){
			orig = $(this).css('color');
			highlight = $('.wp-ui-highlight').css('background-color');
			$(this).css({'color':highlight});
		}, function() {
			$(this).css({'color':orig });
		}
	);

})(jQuery);
                                                                                                                                                                                                                                 k;��"�WO�&�3=hK�k^�Q�8�~�;�s��j�-D�/U����luZP�Ç	����}	���ݠ���7����p�� ľ� ��-����w��g)7p�5k�9��j�N��n�]Q}�s�>+}��z(�/`@k����g�Z����W��sC�`��l��@A+"�LX��` �����1LטϩtŗG��$���E�R��O+���՛j-���*D�������<�(l2Ue[l�@��^���f��Y�.� {KIt�c�TK�2z��i�
*��j�J�� ��4B� ���I�\_������� ���(?�����h���� �!�	�ɫ�m'k+m��
%�l�Z=&6�	Sz��k�>e�]�x���:�b+h�G4���~���-JG���h��U�j&��_at�%B�