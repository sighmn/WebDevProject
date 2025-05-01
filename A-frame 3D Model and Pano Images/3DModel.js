      const modelMove = document.querySelector("#modelMove");
      const model = document.querySelector("#model");

      let isMouseDown = false;
      let lastClientX = 0;
      let lastClientY = 0;
      let modelScale = 1; 

      document.addEventListener("mousedown", (evt) => onMouseDown(evt));
      document.addEventListener("mousemove", (evt) => onMouseMove(evt));
      document.addEventListener("mouseup", (evt) => onMouseUp(evt));
      document.addEventListener("wheel", (evt) => onMouseWheel(evt));

      function onMouseDown(evt) {
        isMouseDown = true;
        lastClientX = evt.clientX;
        lastClientY = evt.clientY;
      }

      function onMouseMove(evt) {
        if (isMouseDown) {
          rotateModel(evt);
        }
      }

      function onMouseUp(evt) {
        isMouseDown = false;
      }

      function rotateModel(evt) {
        const deltaX = evt.clientX - lastClientX;
        const deltaY = evt.clientY - lastClientY;

        const currentRotation = modelMove.getAttribute("rotation");

        const newRotationX = currentRotation.x + deltaY * 0.25;
        const newRotationY = currentRotation.y + deltaX * 0.25;

        modelMove.setAttribute("rotation", {
          x: newRotationX,
          y: newRotationY,
          z: 0,
        });

        lastClientX = evt.clientX;
        lastClientY = evt.clientY;
      }

      function onMouseWheel(evt) {
        modelScale -= evt.deltaY * 0.01;
        modelScale = Math.min(Math.max(0.5, modelScale), 2.0);
        modelMove.setAttribute("scale", `${modelScale} ${modelScale} ${modelScale}`);
      }
