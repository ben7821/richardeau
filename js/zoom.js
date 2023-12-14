// script.js
let initialDistance = 0;
let scaleValue = 1.0;
const zoomTarget = document.getElementById('zoomTarget');

zoomTarget.addEventListener('touchstart', handleTouchStart);
zoomTarget.addEventListener('touchmove', handleTouchMove);
zoomTarget.addEventListener('touchend', handleTouchEnd);

function handleTouchStart(event) {
  if (event.touches.length === 2) {
    initialDistance = getDistanceBetweenTouches(event.touches);
  }
}

function handleTouchMove(event) {
  event.preventDefault(); // Empêche le scroll par défaut

  if (event.touches.length === 2) {
    const currentDistance = getDistanceBetweenTouches(event.touches);
    const delta = currentDistance - initialDistance;
    const sensitivity = 0.01; // Sensibilité du zoom

    scaleValue += delta * sensitivity;
    scaleValue = Math.max(0.5, scaleValue); // Zoom minimum
    scaleValue = Math.min(3, scaleValue); // Zoom maximum

    zoomTarget.style.transform = `scale(${scaleValue})`;
  }
}

function handleTouchEnd(event) {
  if (event.touches.length < 2) {
    initialDistance = 0;
  }
}

function getDistanceBetweenTouches(touches) {
  const x = touches[0].clientX - touches[1].clientX;
  const y = touches[0].clientY - touches[1].clientY;
  return Math.sqrt(x * x + y * y);
}