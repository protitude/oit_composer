!function e(r,n,o){function t(a,u){if(!n[a]){if(!r[a]){var f="function"==typeof require&&require;if(!u&&f)return f(a,!0);if(i)return i(a,!0);var c=new Error("Cannot find module '"+a+"'");throw c.code="MODULE_NOT_FOUND",c}var l=n[a]={exports:{}};r[a][0].call(l.exports,function(e){var n=r[a][1][e];return t(n?n:e)},l,l.exports,e,r,n,o)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<o.length;a++)t(o[a]);return t}({1:[function(e,r,n){var o=new FontFaceObserver("Maitree");o.load().then(function(){document.getElementsByTagName("body")[0].className+=" js-fontloaded"},function(){console.log("Font is not available")})},{}]},{},[1]);