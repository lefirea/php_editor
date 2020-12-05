<script>
function insertTab(o, e){
	var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
	if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey){
		var oS = o.scrollTop;
		if (o.setSelectionRange){
			var sS = o.selectionStart;
			var sE = o.selectionEnd;
			o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
			o.setSelectionRange(sS + 1, sS + 1);
			o.focus();
		}else if (o.createTextRange){
			document.selection.createRange().text = "\t";
			e.returnValue = false;
		}
		o.scrollTop = oS;
		if (e.preventDefault){
			e.preventDefault();
		}
		return false;
	}
	return true;
}
</script>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!--  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
<script src="jquery-linedtextarea.js"></script>
<script>
var _ua = (function(){
	return {
		ltIE6:typeof window.addEventListener == "undefined" && typeof document.documentElement.style.maxHeight == "undefined",
		ltIE7:typeof window.addEventListener == "undefined" && typeof document.querySelectorAll == "undefined",
		ltIE8:typeof window.addEventListener == "undefined" && typeof document.getElementsByClassName == "undefined",
		ltIE9:document.uniqueID && typeof window.matchMedia == "undefined",
		gtIE10:document.uniqueID && window.matchMedia,
		Trident:document.uniqueID,
		Gecko:'MozAppearance' in document.documentElement.style,
		Presto:window.opera,
		Blink:window.chrome,
		Webkit:typeof window.chrome == "undefined" && 'WebkitAppearance' in document.documentElement.style,
		Touch:typeof document.ontouchstart != "undefined",
		Mobile:(typeof window.orientation != "undefined") || (navigator.userAgent.indexOf("Windows Phone") != -1),
		ltAd4_4:typeof window.orientation != "undefined" && typeof(EventSource) == "undefined",	
		Pointer:window.navigator.pointerEnabled,
		MSPoniter:window.navigator.msPointerEnabled
	}
})();

dirname = '/def';
ch_flag = '/def';
ev_flag = '/def';
ev_path_flag = '/def';
lv_flag = "/def";
lv_path_flag = "/def";
cl_flag = "/def";
cl_path_flag = "/def";
dbl_flag = "/def";
err = 'none';

is_bigger_editor = false;
function resize(){
	if(is_bigger_editor){ // big -> small
		$("#editor").removeClass("col-md-12");
		$("#editor").addClass("col-md-6");
		
		$("#result").removeClass("col-md-12");
		$("#result").addClass("col-md-6");
		
		$("#file_tree").removeClass("col-xs-2");
		$("#file_tree").addClass("col-xs-3");
		
		$("#textarea").removeClass("col-xs-10");
		$("#textarea").addClass("col-xs-9");

		is_bigger_editor = false;
		$("#icon_resize").removeClass("glyphicon glyphicon-resize-small");
		$("#icon_resize").addClass("glyphicon glyphicon-resize-full");
	}
	else{ // small -> big
		$("#editor").removeClass("col-md-6");
		$("#editor").addClass("col-md-12");
		
		$("#result").removeClass("col-md-6");
		$("#result").addClass("col-md-12");
		
		$("#file_tree").removeClass("col-xs-3");
		$("#file_tree").addClass("col-xs-2");
		
		$("#textarea").removeClass("col-xs-9");
		$("#textarea").addClass("col-xs-10");

		is_bigger_editor = true;
		$("#icon_resize").removeClass("glyphicon glyphicon-resize-full");
		$("#icon_resize").addClass("glyphicon glyphicon-resize-small");
	}
}

$(document).on("click", "li", function(){

$('#request').keyup(checkChange(this));
function checkChange(e){
    var old = v=$('#refquest').val();
    return function(){
        v=$('#request').val();　　　
        if(old != v){
            old = v;
            ch_flag = 1;
        }
    }
}
Formcheck();
});

$('#btn_upload').click(function(){
	return false;
});
d = new Date;

if (_ua.Gecko) {
	function set_filename(event){
		// イベントオブジェクトが引数に渡されるブラウザでは、ここを通らない
		document.getElementById('old_file').value = document.getElementById('run_file').value;
		var eventClass = event.target.className;
		var f_class= document.getElementsByClassName(eventClass);
		filename = f_class[0].innerHTML;
		if(cl_flag != filename || cl_path_flag == 1){
			document.getElementById('old_file').value = document.getElementById('run_file').value;
			document.getElementById('usingfile').innerHTML = "編集中 : " + filename;
			document.getElementById('run_file').value = filename;
			if(eventClass == null)return;
			$('li').css('color', 'black');
			$('.' + eventClass).css('color', 'Red');
			cl_flag = filename;
			cl_path_flag = 0;
		}
		dir_flag = 0;
 	}
}else{
	function set_filename(){
		var eventClass = event.target.className;
		var f_class= document.getElementsByClassName(eventClass);
		filename = f_class[0].innerHTML;
		if(cl_flag != filename || cl_path_flag == 1){
			document.getElementById('old_file').value = document.getElementById('run_file').value;
			document.getElementById('usingfile').innerHTML = "編集中 : " + filename;
			document.getElementById('run_file').value = filename;
			if(eventClass == null)return;
			$('li').css('color', 'black');
			$('.' + eventClass).css('color', 'Red');
			cl_flag = filename;
			cl_path_flag = 0;
		}
		dir_flag = 0;
	}
}

if (_ua.Gecko) {
	function ch_dir(event){
		// イベントオブジェクトが引数に渡されるブラウザでは、ここを通らない
		lv_flag = "/def";
		document.getElementById('old_file').value = document.getElementById('run_file').value;
		var eventClass = event.target.className;
		var f_class= document.getElementsByClassName(eventClass);
		dirname = f_class[0].innerHTML; 
		if(ev_flag != dirname || ev_path_flag == c_path_old){
			var lognum = "<?php echo $lognum; ?>";
			c_path_old = document.getElementById('c_path').value;
			document.getElementById('c_path').value = document.getElementById('c_path').value + dirname;
			document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML + dirname;		
			ev_flag = dirname;
		}else{
			dbl_flag = 1;
			ev_path_flag = c_path_old;

		}
		dir_flag = 1;
		cl_path_flag = 1;
	}
}else{
	function ch_dir(){
		lv_flag = "/def";
		document.getElementById('old_file').value = document.getElementById('run_file').value;
		var eventClass = event.target.className;
		var f_class= document.getElementsByClassName(eventClass);
		dirname = f_class[0].innerHTML; 
		if(ev_flag != dirname || ev_path_flag == c_path_old){
			var lognum = "<?php echo $lognum; ?>";
			c_path_old = document.getElementById('c_path').value;
			document.getElementById('c_path').value = document.getElementById('c_path').value + dirname;
			document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML + dirname;		
			ev_flag = dirname;
		}else{
			dbl_flag = 1;
			ev_path_flag = c_path_old;

		}
		dir_flag = 1;
		cl_path_flag = 1;
	}
}
if (_ua.Gecko) {
	function level_up(event){
		ev_flag = "/def";
		dir_flag = 2;
		document.getElementById('old_file').value = document.getElementById('run_file').value;
		c_d = document.getElementById('c_path').value.split("/");
		if(lv_flag != $(".back").attr('id')){
			if(c_d[c_d.length-2] != document.getElementById('user').value){
				c_path_old = document.getElementById('c_path').value;
				dirname = c_d[c_d.length-2] + "/";
				document.getElementById('c_path').value = document.getElementById('c_path').value.replace(dirname,"");
				document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML.replace(dirname,"");
			}else{
				if(c_d[2] == c_d[c_d.length-2]){
					_c_path = "";
					for(var i=0; i < c_d.length-2; i++){
						if(c_d[i] != ""){ _c_path += c_d[i]; }
						_c_path += "/";
					}
					document.getElementById("c_path").value = _c_path;
					_current_path = document.getElementById("current_path").innerHTML;
					document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML.replace(dirname,"");
				}else{
					c_path_old = document.getElementById('c_path').value;
					dirname = c_d[c_d.length-2] + "/";
					document.getElementById('c_path').value = document.getElementById('c_path').value;
					document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML.replace(dirname,"");
				}
			}
			lv_flag = $(".back").attr('id');
			cl_path_flag = 1;
		}
	}
}else{
	function level_up(){
		ev_flag = "/def";
		dir_flag = 2;
		document.getElementById('old_file').value = document.getElementById('run_file').value;
		c_d = document.getElementById('c_path').value.split("/");
		if(lv_flag != $(".back").attr('id')){
			if(c_d[c_d.length-2] != document.getElementById('user').value){
				c_path_old = document.getElementById('c_path').value;
				dirname = c_d[c_d.length-2] + "/";
				document.getElementById('c_path').value = document.getElementById('c_path').value.replace(dirname,"");
				document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML.replace(dirname,"");
			}else{
				c_path_old = document.getElementById('c_path').value;
				dirname = c_d[c_d.length-2] + "/";
				document.getElementById('c_path').value = document.getElementById('c_path').value;
				document.getElementById('current_path').innerHTML = document.getElementById('current_path').innerHTML.replace(dirname,"");
			}
			lv_flag = $(".back").attr('id');
			cl_path_flag = 1;
		}
	}
}

function new_file(){
	document.getElementById('old_file').value = document.getElementById('run_file').value;
	document.getElementById('usingfile').innerHTML = "編集中 : 新規ファイル";
	document.getElementById('run_file').value = "";
	cl_path_flag = 1;
}

$(function() {
	$(".lined").linedtextarea(
		//{selectedLine: }
	);
	$("#mytextarea").linedtextarea();
});

$(function(){
	var c = document.getElementById("c_path").value.split("/");
	if(c.length > 4){
		document.getElementById("c_path").value = "/" + c[1] + "/" + c[2] + "/";
	}
});

$(document).ready(function(){
	//新規ファイル
	$('#btn_newfile').click(function(){		
		Formcheck();
		var data = {request : $('#request_RW').val(), name : $('#old_file').val(), c_path: $('#c_path').val() };
		$.ajax({
			type: "POST",
			url: "save.php",
			data: data,
			success: function(data, dataType){
				if(data != "" && data != "succeed"){
					alert(data);
				}      
				document.getElementById('request').value = "";     
				$('li').css('color', 'black');  
 				ch_flag = 0;                                                                          
  			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			}
		});
		/**
		* 操作logの取得
		*/
		var data = {c_path : $('#c_path').val(),operate: "btn_newfile",fname : "none"};
			$.ajax({
				type: "POST",
				url: "get_operatelog.php",
				data: data,
				success: function(data, dataType){
      			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			}
		
		});
	});
	/**
	*テキストエリアにファイル内容を挿入
	*/
 	$(document).on("click", "li", function(){
		if(dir_flag == 0){
			if(ch_flag == 1){
				Formcheck();
				var data = {request : $('#request_RW').val(), name : $('#old_file').val(), c_path: $('#c_path').val() };
				$.ajax({
					type: "POST",
					url: "save.php",
					data: data,
					success: function(data, dataType){
						if(data != "" && data != "succeed"){
							alert(data);
						} 
						select();             
 						ch_flag = 0;                                                                          
  					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
			}
			var data = {c_path: $('#c_path').val(), name: filename};
			$.ajax({
				type: "POST",
				url: "get_text.php",
				data: data,
				success: function(data, dataType){
					document.getElementById('request').value = data;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert('Error : ' + errorThrown);
				}
			});
		}else if(dir_flag == 1){
			Formcheck();
			/**
			* ディレクトリの切り替え
			*/
			var data = {c_path: $('#c_path').val()};
			$.ajax({
				type: "POST",
				url: "ch_dir.php",
				data: data,
				success: function(data, dataType){
					if(data != "this file does not exist"){
						document.getElementById('file_list').innerHTML = data;
						new_file()
						document.getElementById('request').value = ""; 
					}else{
						document.getElementById('c_path').value = c_path_old;
					}
 				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert('Error : ' + errorThrown);
				}
			});
			var data = {request : $('#request_RW').val(), name : $('#old_file').val(), c_path: c_path_old };
			$.ajax({
				type: "POST",
				url: "diff_save.php",
				data: data,
				success: function(data, dataType){
					if(data != "" && data != "succeed"){
						alert(data);
					}
					if(dbl_flag == 1){
						ev_flag="/def";
						dbl_flag = 0;
					}         
 					ch_flag = 0;
  				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert('Error : ' + errorThrown);
				}
			});
 		}else{
 			/**
			* １階層上がる
			*/
			var data = {lognum: $('#user').val(), c_path: $('#c_path').val(), classID: $('#classID').val()};
			$.ajax({
				type: "POST",
				url: "level_up.php",
				data: data,
				success: function(data, dataType){
					document.getElementById('file_list').innerHTML = data;
					new_file();
					document.getElementById('request').value = ""; 
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert('Error : ' + errorThrown);
				}
			});
			Formcheck();
			var data = {request : $('#request_RW').val(), name : $('#old_file').val(), c_path: c_path_old};
			$.ajax({
				type: "POST",
				url: "diff_save.php",
				data: data,
				success: function(data, dataType){
					if(data != "" && data != "succeed"){
						alert(data);
					}             
 					ch_flag = 0;
  				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert('Error : ' + errorThrown);
				}
			});
		}
		/**
		* 操作logの取得
		*/
		var data = {c_path : $('#c_path').val(),operate: "click_list"};
		$.ajax({
			type: "POST",
			url: "get_operatelog.php",
			data: data,
			success: function(data, dataType){
 			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			}
		});
	});
	/**
	*実行結果を表示
	*/
	$('#btn_run').click(function(){
		var data = {request : $('#request_RW').val(), name : $('#run_file').val(), c_path: $('#c_path').val() };
		$.ajax({
			type: "POST",
			url: "save.php",
			data: data,
			success: function(data, dataType){
				ch_flag = 0;                                                                                                  
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			}
		});
		var data = {name: $('#run_file').val(), c_path: $('#c_path').val() };
		$.ajax({
			type: "POST",
			url: "result_d.php",
			data: data,
			success: function(data, dataType){
				if(document.getElementById('run_file').value != ""){
					document.getElementById('result').innerHTML = data;
				}else{
					alert('ファイルが選択されていません。');
				}

			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			}
		});
		/**
		* error表示
		*/
		var data = {c_path : $('#c_path').val(),name : $('#run_file').val()};
		$.ajax({
			type: "POST",
			url: "error_check.php",
			data: data,
			success: function(data, dataType){
				if($('#run_file').val().match(/^[a-zA-Z0-9_\.]+$/)){
					if($('#run_file').val().match(/^[a-zA-Z0-9_]+\.php$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.js$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.css$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.html$/)){
						document.getElementById('err').innerHTML = data;
						document.getElementById('err_str').value = data;
					}
				}
				if(data.match(/エラーはありませんでした/) != null){
					err = "ok";
				}else{
					err = "err";
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			},
			complete:  function(XMLHttpRequest, textStatus){
				/**
				* エラーlogの取得
				*/
				var data = {request : $('#request_RW').val(), c_path : $('#c_path').val(), errstr: $('#err_str').val(), fname: $('#run_file').val(),err : err};
				$.ajax({
					type: "POST",
					url: "get_log.php",
					data: data,
					success: function(data, dataType){
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
				/**
				* 操作logの取得
				*/
				var data = {c_path : $('#c_path').val(),operate: "btn_runfile",fname : $('#run_file').val()};
				$.ajax({	
					type: "POST",
					url: "get_operatelog.php",
					data: data,
					success: function(data, dataType){
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
			}
 		});
	});
	/**
	* 複製ボタンクリック
	*/
	$('#btn_duplicate').click(function(){
		var data = {request : $('#request_RW').val(), name : input_fname, c_path: $('#c_path').val()};
		$.ajax({
			type: "POST",
			url: "save.php",
			data: data,
			success: function(data, dataType){
				if(data != "" && data != "succeed"){
					alert(data);
				}
				if(data == "succeed"){
					document.getElementById('usingfile').innerHTML = "編集中 : " + input_fname;
					document.getElementById('run_file').value = input_fname;
					cl_flag = input_fname;
					filename = input_fname;
				}
 				ch_flag = 0;
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
 			},
    			complete:  function(XMLHttpRequest, textStatus){
				/**
				* file_listの更新
				*/
				var data = {c_path: $('#c_path').val(),lognum: $('#user').val(), classID: $('#classID').val()};
				$.ajax({
					type: "POST",
 					url: "file_list.php",
					data: data,
					success: function(data, dataType){
						document.getElementById('file_list').innerHTML = data;
						select();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
				/**
				* error表示
				*/
				var data = {c_path : $('#c_path').val(),name : $('#run_file').val()};
				$.ajax({
					type: "POST",
					url: "error_check.php",
					data: data,
					success: function(data, dataType){
					if(input_fname.match(/^[a-zA-Z0-9_\.]+$/)){
						if($('#run_file').val().match(/^[a-zA-Z0-9_]+\.php$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.js$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.css$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]+\.html$/)){
							document.getElementById('err').innerHTML = data;
							document.getElementById('err_str').value = data;
						}
					}
						if(data.match(/エラーはありませんでした/) != null){
							err = "ok";
						}else{
							err = "err";
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					},
					complete:  function(XMLHttpRequest, textStatus){
						/**
						* エラーlogの取得
						*/
						var data = {request : $('#request_RW').val(), c_path : $('#c_path').val(), errstr: $('#err_str').val(), fname: input_fname, err : err};
						$.ajax({
							type: "POST",
							url: "get_log.php",
							data: data,
							success: function(data, dataType){
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){
								alert('Error : ' + errorThrown);
							}
						});

					}
				});
				/**
				* 操作logの取得
				*/
				var data = {c_path : $('#c_path').val(),operate: "btn_duplicate",fname : $('#run_file').val()};	
				$.ajax({	
					type: "POST",
					url: "get_operatelog.php",
					data: data,
					success: function(data, dataType){
      					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
			}
		});
	});
	/**
	* 画像アップロード
	*/
	$('#upload_img').on('change', function(){
		var file = $(this).prop('files')[0];
		var formData = new FormData();
		formData.append('file_up', file);
		var data = {c_path: $('#c_path').val()};
		$.ajax({
			type: "POST",
			url:"uploader.php",
			data: data,
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('Error : ' + errorThrown);
			},
			success: function(data, dataType) {
				alert(data);
			}
		});
 	});
	/**
	* 削除ボタンクリック
	*/
	$('#btn_trash').click(function(){
		var data = {name : filename , lognum: $('#user').val(), cof: cof , c_path: $('#c_path').val()};
		$.ajax({
			type: "POST",
			url: "trash.php",
			data: data,
			success: function(data, dataType){
				if(cof == true){
					if(filename == "新規ファイル"){
						alert('削除対象のファイルがありません');
					}
					new_file();
					document.getElementById('request').value = "";
				}else{
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			},
			complete: function(XMLHttpRequest, textStatus){
				/**
				* file_listの更新
				*/
				var data = {c_path: $('#c_path').val(),lognum: $('#user').val(), classID: $('#classID').val()};	
				 $.ajax({
					type: "POST",
					url: "file_list.php",
					data: data,
					success: function(data, dataType){
						document.getElementById('file_list').innerHTML = data;
						select();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
				/**
				* 操作logの取得
				*/
				var data = {c_path : $('#c_path').val(),operate: "btn_trash",fname : filename};
				$.ajax({
					type: "POST",
					url: "get_operatelog.php",
					data: data,
					success: function(data, dataType){
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
			}
		});
	});
	/**
	* 保存ボタンクリック
	*/
	$('#btn_ok').click(function(){
		var data = {request : $('#request_RW').val(), name : input_fname, c_path: $('#c_path').val() };
		$.ajax({
			type: "POST",
			url: "save.php",
			data: data,
			success: function(data, dataType){
				if(data != "" && data != "succeed"){
					alert(data);
					input_fname = document.getElementById('run_file').value;
				}
				if(data == "succeed"){
					document.getElementById('usingfile').innerHTML = "編集中 : " + input_fname;
					document.getElementById('run_file').value = input_fname;
				}
					ch_flag = 0;
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			},
			complete:  function(XMLHttpRequest, textStatus){
				/**
				* file_listの更新
				*/
				var data = {c_path: $('#c_path').val(),lognum: $('#user').val(), classID: $('#classID').val()};
				$.ajax({
					type: "POST",
					url: "file_list.php",
					data: data,
					success: function(data, dataType){
						document.getElementById('file_list').innerHTML = data;
						select();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
 				/**
				* error表示
				*/
				var data = {c_path : $('#c_path').val(),name : input_fname};
				$.ajax({
					type: "POST",
					url: "error_check.php",
					data: data,
					success: function(data, dataType){
					if(input_fname.match(/^[a-zA-Z0-9_\.]+$/)){
						if($('#run_file').val().match(/^[a-zA-Z0-9_]\.php$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]\.js$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]\.css$/) || $('#run_file').val().match(/^[a-zA-Z0-9_]\.html$/)){
							document.getElementById('err').innerHTML = data;
							document.getElementById('err_str').value = data;
						}
					}
						if(data.match(/エラーはありませんでした/) != null){
							err = "ok";
						}else{
							err = "err";
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					},
					complete:  function(XMLHttpRequest, textStatus){
						/**
						* エラーlogの取得
						*/
						var data = {request : $('#request_RW').val(), c_path : $('#c_path').val(), errstr: $('#err_str').val(), fname: input_fname, err : err};
						$.ajax({
							type: "POST",
							url: "get_log.php",
							data: data,
							success: function(data, dataType){
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){
								alert('Error : ' + errorThrown);
							}
						});
						/**
						* 操作logの取得
						*/
						var data = {c_path : $('#c_path').val(),operate: "btn_ok",fname : input_fname};
						$.ajax({
						type: "POST",
						url: "get_operatelog.php",
						data: data,
							success: function(data, dataType){
      							},
							error: function(XMLHttpRequest, textStatus, errorThrown){
								alert('Error : ' + errorThrown);
							}
						});
					}
				});
 			}
 		});
	 });
	/**
	* ディレクトリ作成
	*/
	$('#btn_newfolder').click(function(){
		if(input_dname == document.getElementById("user").value){
			alert("[Error] The folder name is cannot be used.");
			return;
		}
		
		var data = { dirname : input_dname, c_path: $('#c_path').val()};
		$.ajax({
			type: "POST",
			url: "makedir.php",
			data: data,
			success: function(data, dataType){
				if(data != ""){
					alert(data);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				alert('Error : ' + errorThrown);
			},
			complete:  function(XMLHttpRequest, textStatus){
				/**
				* file_listの更新
				*/
				var data = {c_path: $('#c_path').val(), lognum: $('#user').val(), classID: $('#classID').val()};
				$.ajax({
					type: "POST",
					url: "file_list.php",
					data: data,
					success: function(data, dataType){
						document.getElementById('file_list').innerHTML = data;
						select();
					},	
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
				/**
				* 操作logの取得
 				*/
				var data = {c_path : $('#c_path').val(),operate : "btn_newfolder",fname : input_dname};
				$.ajax({
					type: "POST",
					url: "get_operatelog.php",
					data: data,
					success: function(data, dataType){
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						alert('Error : ' + errorThrown);
					}
				});
			}
		});
	});
	//サブミット後、ページをリロードしないようにする
	return false;  
});
</script>
<script type="text/javascript">
/*function Formcheck(){
	var StringFrom = ''; 
	var displaceNumber = 2;  
	var StringAfter = []; 
	var encode = "";                    
	StringFrom = document.getElementById('request').value.split(''); 
	for(var i=0;i<StringFrom.length;i++){
		if(StringFrom[i].charCodeAt() >= 32 && StringFrom[i].charCodeAt() <= 126){
			if(StringFrom[i].charCodeAt() == 125){
				StringAfter[i] = String.fromCharCode(32);
			}else if(StringFrom[i].charCodeAt() == 126){
				StringAfter[i] = String.fromCharCode(33);
			}else{
				StringAfter[i] = String.fromCharCode(StringFrom[i].charCodeAt() + displaceNumber); 
			}
		}else{
			StringAfter[i] = String.fromCharCode(StringFrom[i].charCodeAt());
		}
	}
	encode = StringAfter.join('');
	document.getElementById('request_RW').value = encode;
}

*/

String.prototype.json_escape = function (){
    return ("" + this).replace(/./g, function (c){
        return "\\u" + ("000" + c.charCodeAt(0).toString(16)).slice(-4);
    });
};


function progToObj(prog){
  var res={};
  prog=prog.split("");
  for(var i=0;i<prog.length;i++){
    res[i]=prog[i].json_escape();
  }
  return res;
}


function Formcheck(){
	var content = {
		"source":document.getElementById('request').value
	}
    var progObj=JSON.stringify(progToObj(content.source));
	document.getElementById('request_RW').value = progObj;
}

function input_fn(){
	if(document.getElementById('usingfile').innerHTML.match(/編集中 : 新規ファイル/) ){
		input_fname = window.prompt("半角英数字でファイル名を入力してください。(例 : test.php)","");
	}else{
		input_fname = document.getElementById('run_file').value;
	}
}

function duplicate(){
	input_fname = window.prompt("複製ファイル名を入力してください。(例 : test.php)","");
}

function input_dn(){
	input_dname = window.prompt("フォルダ名を入力してください。\n 例 : test","");
}

function Confirmation(){
	if( document.getElementById('run_file').value == ""){
		filename = "新規ファイル";
	}
	cof = window.confirm('ファイルを削除しますか?');
}
function select(){
	sel = document.getElementById('run_file').value;
	if(document.getElementById(sel) != null){
		document.getElementById(sel).style.color = "red";
	}
}

</script>
