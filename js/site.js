// $popover
var $popover = {
	i: 0,
	popovers: document.querySelectorAll('.gallery-icon>a'),
	init: function(){
		this.popovers.forEach(function(item){
			item.onclick = function(e){
				e.preventDefault();
				//e.stopImmediatePropagation(); //prevents multiple events from being applied
				$popover.load(item.href);
			};
		});
	},
	load: function(href){	
		var href_type = href.split('.');
		var image_types = ['jpg','jpeg','png','webp','gif'];

		// check if href is image or webpage		
		if(image_types.indexOf(href_type[href_type.length-1]) > -1){
			$popover.beforeOpen();
			$popover.createBaseHTML();
			
			$popover.open('<img src="'+ href +'" width="100%" height="auto" />');
			$popover.revealPopover();
		
			
		} else {
			$popover.ajaxCall(href);
		}
	},
	ajaxCall: function(){
		// port to native JS

		/*$.ajax({
			
			url: href,
			beforeSend: function(){ 
				// callback before open starts
				$popover.beforeOpen();
				
				// build HTML wrapper before content arrives	
				$popover.createBaseHTML();
			},
			cache: true
			
		}).done(function(data,status){
			$popover.open(data);
		}).fail(function(){
			$popover.close();
		}).always(function(data,status){			
			$popover.revealPopover();
		});*/
		
	},
	createBaseHTML: function(){
		document.querySelector('body').insertAdjacentHTML("beforeend",'<div id="popover-container"><div id="modal-box"><div id="close-modal-box" class="icon-close-it"></div><div id="modal-box-content"></div></div></div>');
	},
	revealPopover: function(){
		document.querySelector('body').classList.add('modal-on');
	},
	open: function(data){
		
		// sets new history state so $popover can be closed with back button
		history.pushState(null, document.title, "");
		window.onpopstate = function() {
			$popover.close();
		};
		
		// insert new data
		document.querySelector('#modal-box-content').innerHTML = data;
		
		// close on click
		document.querySelector('#popover-container').onclick = function(e){
			if(e.target==this){
				$popover.close(e);
			}
		};
		
		document.querySelector('#close-modal-box').onclick = function(e){
			$popover.close(e);
		};
		
		// close on esc key
		document.querySelector('#close-modal-box').onkeyup = function(e){	
			if(e.keyCode === 27){ $popover.close(e); }
		};
		
		// callback on open
		$popover.afterOpen();
		
	},
	close: function(){
		
		// callback before close starts
		$popover.beforeClose();
		
		document.querySelector('body').classList.remove('modal-on');
		setTimeout(function(){ 
			document.querySelector('#popover-container').remove();
		}, 300);
		
		// callback after close
		$popover.afterClose();
		
	},
	beforeOpen: function(){},
	afterOpen: function(){},
	beforeClose: function(){},
	afterClose: function(){},
};

$popover.init();