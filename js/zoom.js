const zoomContainer = document.getElementById('zoom-container');
const zoomImage = document.getElementById('zoom-image');

let isZoomed = false;
let scale = 1;
let lastScale = 1;
let posX = 0;
let posY = 0;
let lastPosX = 0;
let lastPosY = 0;

const hammer = new Hammer(zoomContainer);

hammer.get('pinch').set({ enable: true });
hammer.get('pan').set({ direction: Hammer.DIRECTION_ALL });

hammer.on('pinchstart', (e) => {
    isZoomed = true;
    lastScale = scale;
});

hammer.on('pinchmove', (e) => {
    scale = Math.max(1, Math.min(lastScale * e.scale, 4));
    updateTransform();
});

hammer.on('pinchend', () => {
    isZoomed = false;
});

hammer.on('panstart', (e) => {
    if (isZoomed) {
        lastPosX = posX;
        lastPosY = posY;
    }
});

hammer.on('panmove', (e) => {
    if (isZoomed) {
        posX = lastPosX + e.deltaX;
        posY = lastPosY + e.deltaY;
        updateTransform();
    }
});

zoomContainer.addEventListener('wheel', (e) => {
    e.preventDefault();
    if (isZoomed) {
        scale = Math.max(1, Math.min(scale - e.deltaY / 100, 4));
        updateTransform();
    }
});

zoomContainer.addEventListener('dblclick', () => {
    toggleFullscreen();
});

function updateTransform() {
    zoomImage.style.transform = `scale(${scale}) translate(${posX}px, ${posY}px)`;
}

function toggleFullscreen() {
    if (!document.fullscreenElement) {
        zoomContainer.requestFullscreen();
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}