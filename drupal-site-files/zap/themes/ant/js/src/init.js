var font = new FontFaceObserver('Maitree');

font.load().then(function () {
    document.getElementsByTagName('body')[0].className+=' js-fontloaded'
}, function () {
    console.log('Font is not available');
});

