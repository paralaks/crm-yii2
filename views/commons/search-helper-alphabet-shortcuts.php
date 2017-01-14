<script>
function submitAlphabetSearch(pLetter)
{
  $('#startWithLetter').val(1);
  $('#<?= $searchId ?>').val(pLetter);
  $('#<?= $formId ?>').submit()
}
</script>

<div class="search-alphabet-shortcuts">
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('a')">a</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('b')">b</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('c')">c</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('d')">d</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('e')">e</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('f')">f</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('g')">g</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('h')">h</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('i')">i</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('j')">j</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('k')">k</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('l')">l</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('m')">m</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('n')">n</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('o')">o</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('p')">p</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('q')">q</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('r')">r</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('s')">s</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('t')">t</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('u')">u</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('v')">v</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('w')">w</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('x')">x</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('y')">y</a></div>
	<div class="letter"><a href="javascript:void(0)" onclick="submitAlphabetSearch('z')">z</a></div>
</div>
