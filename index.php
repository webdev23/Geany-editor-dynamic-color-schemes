<style>
img {vertical-align: middle;}
h3 {display:inline;vertical-align: text-top;}
code {background:silver;font:caption;color:#232466}
span {margin: 10px}
#conf {text-align: right;width: 300px;}
.block {
  width: 20px;
  height: 20px;
  min-width: 20px;
  min-height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
  display: inline-block;
  vertical-align: middle;
}


</style>

<img width="60" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Geany_logo.svg/256px-Geany_logo.svg.png"></img>
<h3> Geany editor dynamic color schemes</h3>
<br>
Run this script from your home for dynamic styling:
<br><p>
<code>
php <(curl https://webdev23.github.io/Geany-editor-dynamic-color-schemes/dynamic_geany)
</code>
</p>
<select id="type" onchange="fetchColors(this.value)">
  <option>html_default</option>
  <option>html_tag</option>
  <option>html_tagunknown</option>
  <option>html_attribute</option>
  <option>html_attributeunknown</option>
  <option>html_number</option>
  <option>html_doublestring</option>
  <option>html_singlestring</option>
  <option>html_other</option>
  <option>html_comment</option>
  <option>html_entity</option>
  <option>html_tagend</option>
  <option>html_xmlstart</option>
  <option>html_xmlend</option>
  <option>html_script</option>
  <option>html_asp</option>
  <option>html_aspat</option>
  <option>html_cdata</option>
  <option>html_question</option>
  <option>html_value</option>
  <option>html_xccomment</option>
  <option>sgml_default</option>
  <option>sgml_comment</option>
  <option>sgml_special</option>
  <option>sgml_command</option>
  <option>sgml_doublestring</option>
  <option>sgml_simplestring</option>
  <option>sgml_1st_param</option>
  <option>sgml_entity</option>
  <option>sgml_block_default</option>
  <option>sgml_1st_param_comment</option>
  <option>sgml_error</option>
  <option>php_default</option>
  <option>php_simplestring</option>
  <option>php_hstring</option>
  <option>php_number</option>
  <option>php_word</option>
  <option>php_variable</option>
  <option>php_comment</option>
  <option>php_commentline</option>
  <option>php_operator</option>
  <option>php_hstring_variable</option>
  <option>php_complex_variable</option>
  <option>jscript_start</option>
  <option>jscript_default</option>
  <option>jscript_comment</option>
  <option>jscript_commentline</option>
  <option>jscript_commentdoc</option>
  <option>jscript_number</option>
  <option>jscript_word</option>
  <option>jscript_keyword</option>
  <option>jscript_doublestring</option>
  <option>jscript_singlestring</option>
  <option>jscript_symbols</option>
  <option>jscript_stringeol</option>
</select>

<form onchange="setType();fetchConf(type.value)">
<input id="cl1" type="color" value="" />
<input id="cl2" type="color" value="" />
</form>

<div id="conf"></div>

<script>
  
function setType(){
  fetch("http://localhost:6363/?set="+type.value+"&color1="+cl1.value.substr(1)+"&color2="+cl2.value.substr(1))
      .then(function(response) { return response.text() })
      .then(function(text) {
        console.log(text)
  })
}

function fetchColors(me){
  fetch("http://localhost:6363/?current="+me)
      .then(function(response) { return response.text() })
      .then(function(text) {
        var colors = text.split(" ")
        cl1.value = "#" + colors[0]
        cl2.value = "#" + colors[1]
  })
}

function fetchConf(me){
  fetch("http://localhost:6363/?current="+me)
      .then(function(response) { return response.text() })
      .then(function(text) {
        var colors = text.split(" ")
        document.getElementById(me).parentElement.children[1].style.background = "#" + colors[0]
        document.getElementById(me).parentElement.children[2].style.background = "#" + colors[1]
  })
}

if (window.location.href .includes("localhost")){
  fetchColors(type.value)
  document.querySelectorAll("#type option").forEach(function(e){
    conf.innerHTML += "<div><tr><span id='"+e.innerText+"'>"+e.innerText+"</span><div onclick='type.value=this.parentElement.children[0].innerText;cl1.click()'  class='block'></div><div onclick='type.value=this.parentElement.children[0].innerText;cl2.click()' class='block'></div></tr></div>"
  })
  document.querySelectorAll("#type option").forEach(function(e){
   fetchConf(e.innerText)
  })
}
else {
   conf.innerHTML += "Dynamic filetype styling.<br>"
   conf.innerHTML += "<img src='https://user-images.githubusercontent.com/2503337/39456700-d10baef0-4ce8-11e8-9a0b-5d919e98da43.gif'></img>"

}
</script>
