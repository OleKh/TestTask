
Validation.add(
    'validate-adverboard-test',
    'Please enter a valid text.',
    function(v) {
    return  Validation.get('IsEmpty').test(v) || /^.*$/.test(v)
})