<?php
class qa_qnumbering_admin {

	function option_default($option) {

		switch($option) {
			case 'qnumbering_plugin_css':
				return '/* Style for QNumbering Plugin LTR */
.qa-question-list-count {
	position: absolute;
	top: 0px;
	right: 0px;
	background: var(--primary);
	color: var(--on-primary);
	padding: 5px 7px;
	border-radius: 0px 4px 0px 4px;
}

/* Style for QNumbering Plugin RTL */
/* .qa-question-list-count {
	position: absolute;
	top: 0px;
	left: 0px;
	background: var(--primary);
	color: var(--on-primary);
	padding: 5px 7px;
	border-radius: 4px 0px 4px 0px;
} */';
			default:
				return null;				
		}

	}

	function allow_template($template)
	{
		return ($template!='admin');
	}	   

	function admin_form(&$qa_content)
	{					   

		// Process form input

		$ok = null;

		if (qa_clicked('qnumbering_save')) {
			foreach($_POST as $i => $v) {

				qa_opt($i,$v);
			}

			$ok = qa_lang('admin/options_saved');


		}
		else if (qa_clicked('qnumbering_reset')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}

		$fields = array();

		$fields[] = array(
				'label' => 'Enable question numbering',
				'tags' => 'NAME="qnumbering_plugin_enable"',
				'value' => qa_opt('qnumbering_plugin_enable'),
				'type' => 'checkbox',
				);





		$fields[] = array(
				'rows' => 8,
				'label' => 'QNumbering CSS',
				'type' => 'textarea',
				'value' => qa_opt('qnumbering_plugin_css'),
				'tags' => 'NAME="qnumbering_plugin_css"',
				);		   




		return array(		   
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,
				'buttons' => array(
					array(
						'label' => qa_lang_html('main/save_button'),
						'tags' => 'NAME="qnumbering_save"',
					     ),
					array(
						'label' => qa_lang_html('admin/reset_options_button'),
						'tags' => 'NAME="qnumbering_reset"',
					     ),
					)
			    );
	}



}

