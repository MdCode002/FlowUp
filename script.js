

// Raccourci pour la fonction console.log

// Sélection d'éléments HTML fréquemment utilisés
const tShirtFrontimg = document.querySelector(".tShirtFront");
const tShirtBackimg = document.querySelector(".tShirtBack");
const tShirtFront = document.querySelector(".tShirtContainerFront");
const tShirtBack = document.querySelector(".tShirtContainerBack");
const canvasContainerF = document.querySelector(".canvasContainerF");
const canvasContainerB = document.querySelector(".canvasContainerB");
const imageInput = document.getElementById('imageInput');
const btnRight = document.getElementById("btnRight");
const btnLeft = document.getElementById("btnLeft");
const textOption = document.getElementById("textOption");
const ProduitOption = document.getElementById("ProduitOption");
const CWhite = document.getElementById("CWhite");
const Cblack = document.getElementById("Cblack");
const canvasFrontBorder = document.getElementById("canvasFront");
const canvasBackBorder = document.getElementById("canvasBack");
const couleur = document.getElementById("couleur");
const Text = document.getElementById("Text");
const addText = document.getElementById("addText");
const fontSelector  = document.getElementById("fontSelector");
const colorselector   = document.getElementById("colorselector");
const valider   = document.getElementById("valider");

let CouleurBorder = "black"

function Border(couleur) {
   canvasFrontBorder.style.border=`2px dashed ${couleur}`
    canvasBackBorder.style.border=`2px dashed ${couleur}`
}
Cblack.addEventListener('click', () => {
    tShirtFrontimg.src = "./T-shirt-Black-Front.png"
    tShirtBackimg.src = "./T-shirt-Black-Back.png"
    // Active bouton
    Cblack.style.border="3px solid white"
    CWhite.style.border="0"
    CGrey.style.border="0"
    CouleurBorder = "white"
    

  });
CGrey.addEventListener('click', () => {
    tShirtFrontimg.src = "./T-shirt-grey-Front.png"
    tShirtBackimg.src = "./T-shirt-grey-Back.png"
    CouleurBorder = "white"  
    // Activ bouton

    CGrey.style.border="3px solid white"
    CWhite.style.border="0"
    Cblack.style.border="0"
    

  });
  
CWhite.addEventListener('click', () => {
    tShirtFrontimg.src = "./2023-08-11.png"
    tShirtBackimg.src = "./2023-08-11 (1).png"
    CouleurBorder = "black"
    CWhite.style.border="3px solid black"
    Cblack.style.border="0"
    CGrey.style.border="0"

  });
  canvasContainerF.addEventListener('mouseover', ()=>{
    Border(CouleurBorder)
  })
  canvasContainerF.addEventListener('mouseout', ()=>{
    canvasFrontBorder.style.border='none'
    canvasBackBorder.style.border='none'
  })
  canvasContainerB.addEventListener('mouseover', ()=>{
   
    Border(CouleurBorder)
  })
  canvasContainerB.addEventListener('mouseout', ()=>{
    canvasFrontBorder.style.border='none'
    canvasBackBorder.style.border='none'
  })

ProduitOption.addEventListener('click', () => {
    ProduitOption.style.background="#727272"
    textOption.style.background="#3a3d41"
    couleur.style.display="inherit"
    Text.style.display="none"

  })
  textOption.addEventListener('click', () => {
    textOption.style.background="#727272"
    ProduitOption.style.background="#3a3d41"
    couleur.style.display="none"
    Text.style.display="flex"

  })



// Ajout d'écouteur d'événement pour déclencher le clic sur le champ d'entrée de l'image
document.getElementById("imageOption").addEventListener('click', () => {
    imageInput.click();
  });
let front = true;

const updateZIndex = () => {
  if (front) {
    tShirtBack.style.zIndex = '1';
    canvasContainerB.style.zIndex = '2';
    tShirtFront.style.zIndex = '10';
    canvasContainerF.style.zIndex = '11';
  } else {
    tShirtFront.style.zIndex = '1';
    canvasContainerF.style.zIndex = '2';
    tShirtBack.style.zIndex = '13';
    canvasContainerB.style.zIndex = '14';
  }
};



// Changer l'image
imageInput.addEventListener('change', (event) => {
  const file = event.target.files[0];
  const canvas = front ? canvasFront : canvasBack;

  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      const img = new Image();
      img.src = e.target.result;

      img.onload = () => {
        const fabricImage = new fabric.Image(img);
        fabricImage.scaleToWidth(100);
        fabricImage.set({ left: 50, top: 50 });
        canvas.add(fabricImage);
        canvas.renderAll();
      };
    };
    reader.readAsDataURL(file);
    imageInput.value = "";
  }
});


// Ajouter du text 
addText.addEventListener('click', () => {
// Mise à jour de l'écouteur d'événement pour ajouter du texte au canevas
    const color = colorselector.value
    const font = fontSelector.value

  const canvas = front ? canvasFront : canvasBack;

  const text = new fabric.Textbox('Votre texte ici', {
    left: 50,
    top: 50,
    width: 150,
    fontSize: 16,
    fill: color,
    fontFamily: font,
    textAlign: 'center',
    editable: true,
  });

  // Ajouter le texte et la liste déroulante au canevas
  canvas.add(text);
  canvasContainerF.appendChild(fontSelect);
  canvas.renderAll();
});




// Bouton Droite
btnRight.addEventListener("click", () => {
  front = false;
  updateZIndex();
});

// Bouton Gauche
btnLeft.addEventListener("click", () => {
  front = true;
  updateZIndex();
});

// Initialisation des toiles Fabric.js
const widthC = (parseFloat(tShirtFront.offsetWidth) * 160) / 399;
const heightC = (parseFloat(tShirtFront.offsetHeight) * 350) / 466;
console.log(widthC, heightC,tShirtFront.offsetWidth,tShirtFront.style.height);

const canvasOptions = {
  width: widthC,
  height: heightC,
};

const canvasFront = new fabric.Canvas('canvasFront', canvasOptions);
const canvasBack = new fabric.Canvas('canvasBack', canvasOptions);




function captureAndDownload(container,nameFichier) {
  html2canvas(container, { allowTaint: true }).then(function (canvas) {

      var link = document.createElement("a");
      document.body.appendChild(link);
      link.download = nameFichier;
      link.href = canvas.toDataURL();
      console.log(link.href);
      link.target = '_blank';
      link.click();
  });
}


// Capture d'écran de la div et téléchargement
valider.addEventListener("click",() => {
  captureAndDownload(tShirtFront,"T-shirtFront.jpg") 
  captureAndDownload(tShirtBack,"T-shirtBack.jpg") 

    });
 


// Initialisation de l'interface
updateZIndex();
