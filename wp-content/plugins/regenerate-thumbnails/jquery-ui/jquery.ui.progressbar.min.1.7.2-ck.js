/*
 * jQuery UI Progressbar 1.7.2
 *
 * Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://docs.jquery.com/UI/Progressbar
 *
 * Depends:
 *   ui.core.js
 */(function(e){e.widget("ui.progressbar",{_init:function(){this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({role:"progressbar","aria-valuemin":this._valueMin(),"aria-valuemax":this._valueMax(),"aria-valuenow":this._value()});this.valueDiv=e('<div class="ui-progressbar-value ui-widget-header ui-corner-left"></div>').appendTo(this.element);this._refreshValue()},destroy:function(){this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow").removeData("progressbar").unbind(".progressbar");this.valueDiv.remove();e.widget.prototype.destroy.apply(this,arguments)},value:function(e){if(e===undefined)return this._value();this._setData("value",e);return this},_setData:function(t,n){switch(t){case"value":this.options.value=n;this._refreshValue();this._trigger("change",null,{})}e.widget.prototype._setData.apply(this,arguments)},_value:function(){var e=this.options.value;e<this._valueMin()&&(e=this._valueMin());e>this._valueMax()&&(e=this._valueMax());return e},_valueMin:function(){var e=0;return e},_valueMax:function(){var e=100;return e},_refreshValue:function(){var e=this.value();this.valueDiv[e==this._valueMax()?"addClass":"removeClass"]("ui-corner-right");this.valueDiv.width(e+"%");this.element.attr("aria-valuenow",e)}});e.extend(e.ui.progressbar,{version:"1.7.2",defaults:{value:0}})})(jQuery);