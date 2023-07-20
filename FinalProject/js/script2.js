window.onload = function init() {
    makeSelected();
}


function makeSelected () {
    const selectObj1 = document.querySelector('#urg');
    const selectObj2 = document.querySelector('#btype');
    const selectObj3 = document.querySelector('#etype');
    const selectObj4 = document.querySelector('#haz');


    ind1 = selectObj1.dataset.selected;
    console.log(ind1);
    selectObj1.options[ind1-1].selected = true;

    ind2 = selectObj2.dataset.selected;
    console.log(ind2);
    selectObj2.options[ind2-1].selected = true;

    ind3 = selectObj3.dataset.selected;
    console.log(ind3);
    selectObj3.options[ind3-1].selected = true;
    
    ind4 = selectObj4.dataset.selected;
    console.log(ind4);
    selectObj4.options[ind4-1].selected = true;
}