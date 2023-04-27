window.onload = () => {
    let size;
    var counter=0;
    const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    let clickable = true;
    
    document.getElementById('blackBox').addEventListener('click', function () {
        for (let i=0 ;i<3; i++) {
            let newBox = document.createElement('div');
            const letter = letters[Math.floor(Math.random() * letters.length)];
            newBox.textContent = letter;
            newBox.style.color = 'black';
            newBox.className = 'gameBox';
            newBox.id = 'box-' + counter;
            size = 80 + counter*20;
            newBox.style.width = size + 'px';
            newBox.style.height = size + 'px';
            counter++;
            document.getElementById('game').appendChild(newBox);
        }

        let pair1=null, pair2=null;
        const boxes=document.querySelectorAll('.gameBox');
        boxes.forEach(box => box.addEventListener('click', function clickOnBox() {
            if (!clickable || this.classList.contains('clicked') || this.classList.contains('match')){
                return;
            }

            this.classList.add('clicked');
            this.style.color = 'white';
            if (!pair1) {
                pair1 = this;
            } else if (!pair2) {
                pair2 = this;
                clickable = false;

                if (pair1.textContent === pair2.textContent) {
                    setTimeout(() => {
                        pair1.classList.remove('clicked');
                        pair2.classList.remove('clicked');
                        pair1.classList.add('match');
                        pair2.classList.add('match');
                        pair1 = null;
                        pair2 = null;
                        clickable = true;
                    }, 1000);
                } else {
                    setTimeout(() => {
                        pair1.style.color='black';
                        pair2.style.color='black';
                        pair1.classList.remove('clicked');
                        pair2.classList.remove('clicked');
                        pair1 = null;
                        pair2 = null;
                        clickable = true;
                    }, 1000);
                }
            }
        })
    )
    })
}
