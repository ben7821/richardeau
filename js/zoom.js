document.addEventListener('DOMContentLoaded', function () {
    var canvas = new fabric.Canvas('canvas', {
      selection: false,
      backgroundColor: 'rgba(0, 0, 0, 0)', // Fond transparent
      width: window.innerWidth,  // Définir la largeur de la toile par défaut
      height: window.innerHeight  // Définir la hauteur de la toile par défaut
    });
  
    var originalZoom = 1;
  
    // Ajoutez votre image à la toile
    fabric.Image.fromURL('../map/Map1.jpg', function (img) {
      // Définir la taille par défaut de l'image
      var defaultImageWidth = img.width;
      var defaultImageHeight = img.height;
  
      img.set({
        left: (canvas.width - defaultImageWidth) / 2,
        top: (canvas.height - defaultImageHeight) / 2,
        width: defaultImageWidth,
        height: defaultImageHeight,
        originX: 'left',
        originY: 'top',
        selectable: false
      });
  
      canvas.add(img);
      originalZoom = 1;
      canvas.setZoom(originalZoom);
      canvas.centerObject(img);
      canvas.renderAll();
    });
  
    // Ajoutez des gestionnaires d'événements pour le zoom
    canvas.on('mouse:wheel', function (opt) {
      var delta = opt.e.deltaY;
      var zoom = canvas.getZoom();
      zoom *= 0.999 ** delta;
      if (zoom > 20) zoom = 20;
      if (zoom < 1) zoom = 1;
      canvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
      opt.e.preventDefault();
      opt.e.stopPropagation();
    });
  
    // Ajoutez des gestionnaires d'événements pour le déplacement
    var isDragging = false;
    var lastPosX, lastPosY;
    canvas.on('mouse:down', function (opt) {
      // Vérifiez si le clic droit est détecté
      if (opt.e.button === 2 || opt.e.which === 3) {
        zoomOut();
      } else {
        isDragging = true;
        var e = opt.e;
        lastPosX = e.clientX;
        lastPosY = e.clientY;
      }
    });
  
    canvas.on('mouse:move', function (opt) {
      if (isDragging) {
        var e = opt.e;
        var zoom = canvas.getZoom();
        var vpt = canvas.viewportTransform;
  
        vpt[4] += (e.clientX - lastPosX) / zoom;
        vpt[5] += (e.clientY - lastPosY) / zoom;
  
        lastPosX = e.clientX;
        lastPosY = e.clientY;
  
        canvas.requestRenderAll();
      }
    });
  
    canvas.on('mouse:up', function () {
      isDragging = false;
    });
  
    // Redimensionnez la toile lorsque la fenêtre est redimensionnée
    window.addEventListener('resize', function () {
      canvas.setDimensions({
        width: window.innerWidth,
        height: window.innerHeight
      });
  
      // Centrez l'image après le redimensionnement
      var img = canvas.item(0);
      if (img) {
        img.set({
          left: (canvas.width - img.width) / 2,
          top: (canvas.height - img.height) / 2
        });
        canvas.renderAll();
      }
    });
  
    function zoomOut() {
      originalZoom *= 0.8; // Ajustez le facteur de dézoom selon vos préférences
      canvas.zoomToPoint({ x: canvas.width / 2, y: canvas.height / 2 }, originalZoom);
    }
  });