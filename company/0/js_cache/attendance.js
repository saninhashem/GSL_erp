function add_more(){var items=document.getElementById("add_more").getElementsByTagName("input");var html='<input type="text" size="6" name="in_time[]" value="" /><input type="text" size="6" name="out_time[]" value="" />';if(items[0]!=null){var total=items.length;items[total-1].createElement(html);}else{document.getElementById("add_more").innerHTML=html;}
}
