<?php
/**
 * 分页组件 fpage(PHP)
 * 
 * @author Jun Wu
 * @version 1.1.1 2012-06-05
 * @param Integer current 当前页
 * @param Integer total 结果总数
 * @param Integer per 每页显示数
 * @param String type 链接类型。js为javascript，link为普通超链接
 * @param String ext 链接字串。如'?type=abc&p='则输出“?type=abc&p=页码”的链接
 * @param String mode 输出格式(可重复)。<表示“上一页”，>表示下一页，*表示页码区，=表示跳转区。
 */

class fpage {
	static private $o;
	
	public function __construct($o) {
		$o = json_decode ( $o, true );
		
		$this->current = intval ( $o ['current'] );
		$this->total = intval ( $o ['total'] );
		$this->per = intval ( $o ['per'] );
		$this->total_page = ceil ( $this->total / $this->per );
		$this->type = $o ['type'];
		$this->ext = $o ['ext'];
		$this->mode = $o ['mode'];
	}
	
	/**
	 * 翻页渲染
	 */
	public function show() {
		$this->l = explode ( '###', $this->ext );
		
		if ($this->current < 1) {
			$this->current = 1;
		}
		if ($this->current > $this->total_page) {
			$this->current = $this->total_page;
		}
		
		if ($this->total > 0) {
			// 上一页
			$this->to_prev = ' <button class="btn wd2"';
			if ($this->current == 1) {
				$this->to_prev .= ' disabled="disabled"';
			}
			$this->to_prev .= ' onClick="';
			$this->to_prev .= $this->l [0];
			$this->to_prev .= ($this->current - 1);
			if (! empty ( $this->l [1] )) {
				$this->to_prev .= $this->l [1];
			}
			$this->to_prev .= '">';
			$this->to_prev .= '上一页';
			$this->to_prev .= '</button> ';
			
			// 下一页
			$this->to_next = ' <button class="btn wd2"';
			if ($this->current == $this->total_page) {
				$this->to_next .= ' disabled="disabled"';
			}
			$this->to_next .= ' onClick="';
			$this->to_next .= $this->l [0];
			$this->to_next .= ($this->current + 1);
			if (! empty ( $this->l [1] )) {
				$this->to_next .= $this->l [1];
			}
			$this->to_next .= '">';
			$this->to_next .= '下一页';
			$this->to_next .= '</button> ';
			
			// 分页
			$this->pages = '';
			if ($this->total_page <= 10) {
				for($i = 1; $i <= $this->total_page; $i ++) {
					if ($i != $this->current) {
						$this->pages .= ' <a href="';
						$this->pages .= $this->l [0];
						$this->pages .= $i;
						if (! empty ( $this->l [1] )) {
							$this->pages .= $this->l [1];
						}
						$this->pages .= '">';
					}
					
					if ($i == $this->current) {
						$this->pages .= '<strong>';
					}
					
					$this->pages .= $i;
					
					if ($i == $this->current) {
						$this->pages .= '</strong>';
					}
					
					if ($i != $this->current) {
						$this->pages .= '</a> ';
					}
				}
			} else {
				if ($this->current < 10) {
					for($i = 1; $i <= 10; $i ++) {
						if ($i != $this->current) {
							$this->pages .= ' <a href="';
							$this->pages .= $this->l [0];
							$this->pages .= $i;
							if (! empty ( $this->l [1] )) {
								$this->pages .= $this->l [1];
							}
							$this->pages .= '">';
						}
						
						if ($i == $this->current) {
							$this->pages .= '<strong>';
						}
						
						$this->pages .= $i;
						
						if ($i == $this->current) {
							$this->pages .= '</strong>';
						}
						
						if ($i != $this->current) {
							$this->pages .= '</a> ';
						}
					}
					
					$this->pages .= ' ... ';
					
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= $this->total_page;
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= $this->total_page;
					$this->pages .= '</a> ';
				} else if (($this->total_page - $this->current) < 10) {
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= '1';
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= '1';
					$this->pages .= '</a> ';
					
					$this->pages .= ' ... ';
					
					for($i = ($this->total_page - 10); $i <= $this->total_page; $i ++) {
						if ($i != $this->current) {
							$this->pages .= ' <a href="';
							$this->pages .= $this->l [0];
							$this->pages .= $i;
							if (! empty ( $this->l [1] )) {
								$this->pages .= $this->l [1];
							}
							$this->pages .= '">';
						}
						
						if ($i == $this->current) {
							$this->pages .= '<strong>';
						}
						
						$this->pages .= $i;
						
						if ($i == $this->current) {
							$this->pages .= '</strong>';
						}
						
						if ($i != $this->current) {
							$this->pages .= '</a> ';
						}
					}
				} else {
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= '1';
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= '1';
					$this->pages .= '</a> ';
					
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= '2';
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= '2';
					$this->pages .= '</a> ';
					
					$this->pages .= ' ... ';
					
					for($i = ($this->current - 5); $i <= ($this->current + 5); $i ++) {
						if ($i != $this->current) {
							$this->pages .= ' <a href="';
							$this->pages .= $this->l [0];
							$this->pages .= $i;
							if (! empty ( $this->l [1] )) {
								$this->pages .= $this->l [1];
							}
							$this->pages .= '">';
						}
						
						if ($i == $this->current) {
							$this->pages .= '<strong>';
						}
						
						$this->pages .= $i;
						
						if ($i == $this->current) {
							$this->pages .= '</strong>';
						}
						
						if ($i != $this->current) {
							$this->pages .= '</a> ';
						}
					}
					
					$this->pages .= ' ... ';
					
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= ($this->total_page - 1);
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= ($this->total_page - 1);
					$this->pages .= '</a> ';
					
					$this->pages .= ' <a href="';
					$this->pages .= $this->l [0];
					$this->pages .= $this->total_page;
					if (! empty ( $this->l [1] )) {
						$this->pages .= $this->l [1];
					}
					$this->pages .= '">';
					$this->pages .= $this->total_page;
					$this->pages .= '</a> ';
				}
			}
			
			// 跳转翻页区
			$this->form = ' <span>到第 ';
			$this->form .= ' <input type="text" value="';
			
			$this->form .= $this->current;
			$this->form .= '" /> 页 ';
			$this->form .= ' <button class="btn wd2" onClick="';
			if ($this->type == 'link') {
				$this->form .= 'window.location=\'';
			}
			$this->form .= $this->l [0];
			$this->form .= '$this->parentNode.getElementsByTagName(\'input\')[0].value';
			if (! empty ( $this->l [1] )) {
				$this->form .= $this->l [1];
			}
			if ($this->type == 'link') {
				$this->form .= '\'';
			}
			$this->form .= '">';
			$this->form .= '确定';
			$this->form .= '</button></span> ';
		}
		
		$this->str = str_split ( $this->mode );
		$this->page_area = '';
		for($j = 0; $j < count ( $this->str ); $j ++) {
			$this->show_nav ( $this->str [$j] );
		}
		
		return $this->page_area;
	}
	
	/**
	 * 整理输出顺序
	 */
	private function show_nav($e) {
		switch ($e) {
			case '<' : // 上一页
				$this->page_area .= $this->to_prev;
				break;
			
			case '>' : // 下一页
				$this->page_area .= $this->to_next;
				break;
			
			case '*' : // 分页
				$this->page_area .= $this->pages;
				break;
			
			case '=' : // 跳转翻页区
				$this->page_area .= $this->form;
				break;
		}
		return;
	}

}
?>