const score1 = document.getElementById("score1");

const head1 = document.getElementById("head1");
const arm1 = document.getElementById("arm1");
const chest1 = document.getElementById("chest1");
const knees1 = document.getElementById("knees1");
const plus1 = document.getElementById("plus1-1");
const minus1 = document.getElementById("minus1-1");

const undo1 = document.getElementById("undo-1");

let count1 = 0;

// UNDO FOR MAIN BUTTONS

let previousCounts1 = [];

function updateCounter1() {
  score1.textContent = count1;
}

function undoOne() {
  if (previousCounts1.length > 0) {
    count1 = previousCounts1.pop();
    updateCounter1();
  }
}

undo1.addEventListener("click", undoOne);

// MAIN POINT BUTTONS

head1.addEventListener("click", () => {
  previousCounts1.push(count1);
  count1 += 3;
  score1.textContent = count1;
  minus1.disabled = false;
  updateCounter1();
});

arm1.addEventListener("click", () => {
  previousCounts1.push(count1);
  count1 += 1;
  score1.textContent = count1;
  minus1.disabled = false;
  updateCounter1();
});

chest1.addEventListener("click", () => {
  previousCounts1.push(count1);
  count1 += 1;
  score1.textContent = count1;
  minus1.disabled = false;
  updateCounter1();
});

knees1.addEventListener("click", () => {
  previousCounts1.push(count1);
  count1 += 1;
  score1.textContent = count1;
  minus1.disabled = false;
  updateCounter1();
});

//PLUS AND MINUS BUTTON

plus1.addEventListener("click", () => {
  previousCounts1.push(count1);
  count1++;
  score1.textContent = count1;
  minus1.disabled = false;
  updateCounter1();
});

minus1.addEventListener("click", () => {
  if (count1 === 0) {
    minus1.disabled = true;
  } else {
    previousCounts1.push(count1);
    count1 -= 1;
    score1.textContent = count1;
    updateCounter1();
  }
});

//FOUL AND DISARM BUTTONS FOR PLAYER

const foul1 = document.getElementById("foul1");
const foul1Btn = document.getElementById("foulBtn1");
const foulUndoBtn1 = document.getElementById("foulUndoBtn1");

let foulCount1 = 0;
const foulHistory1 = [];

foul1Btn.addEventListener("click", () => {
  foulHistory1.push(foulCount1);
  foulCount1 += 1;
  foul1.textContent = `Fouls: ${foulCount1}`;
  foulUndoBtn1.classList.remove("d-none");
});

foulUndoBtn1.addEventListener("click", () => {
  if (foulHistory1.length > 0) {
    foulCount1 = foulHistory1.pop();
    foul1.textContent = `Fouls: ${foulCount1}`;
    if (foulHistory1.length === 0) {
      foulUndoBtn1.classList.add("d-none");
    }
  }
});

const disarm1 = document.getElementById("disarm1");
const disarm1Btn = document.getElementById("disarmBtn1");
const disarmUndoBtn1 = document.getElementById("disarmUndoBtn1");

let disarmCount1 = 0;
const disarmHistory1 = [];

disarm1Btn.addEventListener("click", () => {
  disarmHistory1.push(disarmCount1);
  disarmCount1 += 1;
  disarm1.textContent = `Disarm: ${disarmCount1}`;
  disarmUndoBtn1.classList.remove("d-none");
});

disarmUndoBtn1.addEventListener("click", () => {
  if (disarmHistory1.length > 0) {
    disarmCount1 = disarmHistory1.pop();
    disarm1.textContent = `Disarm: ${disarmCount1}`;
    if (disarmHistory1.length === 0) {
      disarmUndoBtn1.classList.add("d-none");
    }
  }
});

//SCORE 2

const score2 = document.getElementById("score2");

const head2 = document.getElementById("head2");
const arm2 = document.getElementById("arm2");
const chest2 = document.getElementById("chest2");
const knees2 = document.getElementById("knees2");
const plus2 = document.getElementById("plus1-2");
const minus2 = document.getElementById("minus1-2");

const undo2 = document.getElementById("undo-2");

let count2 = 0;

// UNDO FOR MAIN BUTTONS

let previousCounts2 = [];

function updateCounter2() {
  score2.textContent = count2;
}

function undoTwo() {
  if (previousCounts2.length > 0) {
    count2 = previousCounts2.pop();
    updateCounter2();
  }
}

undo2.addEventListener("click", undoTwo);

// MAIN POINT BUTTONS

head2.addEventListener("click", () => {
  previousCounts2.push(count2);
  count2 += 3;
  score2.textContent = count2;
  minus2.disabled = false;
  updateCounter2();
});

arm2.addEventListener("click", () => {
  previousCounts2.push(count2);
  count2 += 1;
  score2.textContent = count2;
  minus2.disabled = false;
  updateCounter2();
});

chest2.addEventListener("click", () => {
  previousCounts2.push(count2);
  count2 += 1;
  score2.textContent = count2;
  minus2.disabled = false;
  updateCounter2();
});

knees2.addEventListener("click", () => {
  previousCounts2.push(count2);
  count2 += 1;
  score2.textContent = count2;
  minus2.disabled = false;
  updateCounter2();
});

//PLUS AND MINUS BUTTON

plus2.addEventListener("click", () => {
  previousCounts1.push(count2);
  count2++;
  score2.textContent = count2;
  minus2.disabled = false;
  updateCounter2();
});

minus2.addEventListener("click", () => {
  if (count2 === 0) {
    minus2.disabled = true;
  } else {
    previousCounts1.push(count2);
    count2 -= 1;
    score2.textContent = count2;
    updateCounter2();
  }
});

//FOUL AND DISARM BUTTONS FOR PLAYER 2

const foul2 = document.getElementById("foul2");
const foul1Btn2 = document.getElementById("foulBtn2");
const foulUndoBtn2 = document.getElementById("foulUndoBtn2");

let foulCount2 = 0;
const foulHistory2 = [];

foul1Btn2.addEventListener("click", () => {
  foulHistory2.push(foulCount2);
  foulCount2 += 1;
  foul2.textContent = `Fouls: ${foulCount2}`;
  foulUndoBtn2.classList.remove("d-none");
});

foulUndoBtn2.addEventListener("click", () => {
  if (foulHistory2.length > 0) {
    foulCount2 = foulHistory2.pop();
    foul2.textContent = `Fouls: ${foulCount2}`;
    if (foulHistory2.length === 0) {
      foulUndoBtn2.classList.add("d-none");
    }
  }
});

const disarm2 = document.getElementById("disarm2");
const disarm1Btn2 = document.getElementById("disarmBtn2");
const disarmUndoBtn2 = document.getElementById("disarmUndoBtn2");

let disarmCount2 = 0;
const disarmHistory2 = [];

disarm1Btn2.addEventListener("click", () => {
  disarmHistory2.push(disarmCount2);
  disarmCount2 += 1;
  disarm2.textContent = `Disarm: ${disarmCount2}`;
  disarmUndoBtn2.classList.remove("d-none");
});

disarmUndoBtn2.addEventListener("click", () => {
  if (disarmHistory2.length > 0) {
    disarmCount2 = disarmHistory2.pop();
    disarm2.textContent = `Disarm: ${disarmCount2}`;
    if (disarmHistory2.length === 0) {
      disarmUndoBtn2.classList.add("d-none");
    }
  }
});
