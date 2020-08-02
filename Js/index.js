/************************************************************************************************** */
class TypeWriter {
  constructor(txtElement, words, wait = 3000) {
    this.txtElement = txtElement;
    this.words = words;
    this.txt = '';
    this.wordIndex = 0;
    this.wait = parseInt(wait, 10);
    this.type();
    this.isDeleting = false;
  }

  type() {
    // Current index of word
    const current = this.wordIndex % this.words.length;
    // Get full text of current word
    const fullTxt = this.words[current];

    // Check if deleting
    if(this.isDeleting) {
      // Remove char
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      // Add char
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    // Insert txt into element
    this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

    // Initial Type Speed
    let typeSpeed = 300;

    if(this.isDeleting) {
      typeSpeed /= 2;
    }

    // If word is complete
    if(!this.isDeleting && this.txt === fullTxt) {
      // Make pause at end
      typeSpeed = this.wait;
      // Set delete to true
      this.isDeleting = true;
    } else if(this.isDeleting && this.txt === '') {
      this.isDeleting = false;
      // Move to next word
      this.wordIndex++;
      // Pause before start typing
      typeSpeed = 500;
    }

    setTimeout(() => this.type(), typeSpeed);
  }
}


// Init On DOM Load
document.addEventListener('DOMContentLoaded', init);

// Init App
function init() {
  const txtElement = document.querySelector('.txt-type');
  const words = JSON.parse(txtElement.getAttribute('data-words'));
  const wait = txtElement.getAttribute('data-wait');
  // Init TypeWriter
  new TypeWriter(txtElement, words, wait);
}


/******************************************************************** */








function sleepFor( sleepDuration ){
  var now = new Date().getTime();
  while(new Date().getTime() < now + sleepDuration){ /* do nothing */ } 
}
function Question_1(){
  $(".result").hide();
  $(".Question_1_Reponce").show();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
 }
 function Question_2(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").show();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
  $(".result").hide();
  
 }
 function Question_3(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").show();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
  $(".result").hide();
 }
 function Question_4(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").show();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
  $(".result").hide();
 }
 function Question_5(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").show();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
  $(".result").hide();
 }
 function Question_6(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").show();
  $(".Question_7_Reponce").hide();
  $(".result").hide();
 }
 function Question_7(){
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").show();
  $(".result").hide();
 }
 function clear_screen(){
  $(".result").hide();
  $(".Question_1_Reponce").hide();
  $(".Question_2_Reponce").hide();
  $(".Question_3_Reponce").hide();
  $(".Question_4_Reponce").hide();
  $(".Question_5_Reponce").hide();
  $(".Question_6_Reponce").hide();
  $(".Question_7_Reponce").hide();
 }
