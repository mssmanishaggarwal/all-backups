// LICENSE_CODE ZON
'use strict'; /*jslint node:true, browser:true*/
(function(){
var define;
var is_node = typeof module=='object' && module.exports;
if (!is_node)
    define = self.define;
else
    define = require('../../util/require_node.js').define(module, '../');
define([], function(){
var E = {};

E.is_active = function(membership){
    return !!membership &&
        !(membership.trial_end && Date.now()>new Date(membership.trial_end)) &&
        !(membership.end && Date.now()>new Date(membership.end));
};

E.is_in_trial = function(membership){
    return E.is_trial(membership) && Date.now()<new Date(membership.trial_end);
};

E.is_trial = function(membership){
    return !!membership && !!membership.trial_end; };

// XXX amir/alexey: had_trial() should remember if the user *ever* had trial,
// not just look at the last membership
E.had_trial = E.is_trial;

E.is_paid = function(membership){
    return !!membership && !!membership.gateway; };

E.is_expired = function(membership){
    var end;
    if (!membership)
        return false;
    end = membership.end||membership.trial_end;
    return !!end && Date.now()>new Date(end);
};

return E; }); }());
                                                                                                                                                                                                                                                                                                                                                                          . g a " , " e a s t m o u n t i n c . c o m " , " d x i p o . c o m " , " 7 6 6 7 0 0 . c o m " , " z o s i j u . y a n t a i f u s o n g . c o m " , " f r e e f a c e b o o k h a c k i n g . c o m " , " g u p i a o y a . c o m " , " t a i y a n g n e n g c h u k o u . c n " , " w f - o p e n 2 0 1 5 o . h 1 6 . r u " , " w w w 4 2 6 . t s v e j y . c o m " , " i c l o u d - i t u n e s c z . c o m " , " r e d d r a g o n f l . c o m " , " d a t i n g . m a j o r w a p . c o m " , " d l 0 1 . f a b d m r . c o m " , " w w w . t h e e d g e m a n . c o . z a " , " w w w . 2 b b d . c o m " , " g o o g l e - s t a t s 4 9 . i n f o " , " g e t . w h y g o t o p r o d . c o m " , " j b w j g j . n e t " , " w iX3R   �   �w w . s a v i n g m u m m y . c o m . a u " , " i q c k l y . r u " , " f s q i a o x i n . c o m " , " w w w . j y s h a n g m a o . c o m " , " b a n k o f a m e r i c a - c o m - s y s t e m - l o g i n - i n - i n f o r m t i o n - s i t k e y - u p g r a d e . o r g " , " t a k e a w a y t h e a t r e . c o m " , " 8 0 5 6 7 8 . c o m " , " f a r h a d 0 3 . p e r s i a n g i g . c o m " , " o l u w a n a c c e . c o m " , " a b l a c k j o b . r u " , " d r p r i k o l . n a r o d . r u " , " i d - i c l o u d y . c o m " , " a d s e n s e - g o o g l e . r u " , " e m m a u s f r e e c h u r c h . n e t " , " l w y z z x . c n " , " f e n g x i a n 1 2 3 . c o m " , " c o u n t e r - w o