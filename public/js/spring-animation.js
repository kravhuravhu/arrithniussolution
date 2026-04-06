(function() {
    const canvas = document.getElementById('springCanvas');
    if (!canvas) return;
    
    let ctx = canvas.getContext('2d');
    let width, height;
    
    // Multiple sphere objects
    let spheres = [];
    let rotatingShapes = [];
    let particles = [];
    
    function resizeCanvas() {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
        initScene();
    }
    
    class RotatingSphere {
        constructor(centerX, centerY, radius, speedX, speedY, speedZ, color, lineCount = 200) {
            this.centerX = centerX;
            this.centerY = centerY;
            this.radius = radius;
            this.speedX = speedX;
            this.speedY = speedY;
            this.speedZ = speedZ;
            this.color = color;
            this.rotX = Math.random() * Math.PI * 2;
            this.rotY = Math.random() * Math.PI * 2;
            this.rotZ = Math.random() * Math.PI * 2;
            this.points = [];
            this.lines = [];
            this.initPoints(lineCount);
        }
        
        initPoints(count) {
            this.points = [];
            this.lines = [];
            
            // Create spring/helix points on sphere
            for (let i = 0; i < count; i++) {
                const t = i / count;
                const strands = 4;
                const strandIndex = i % strands;
                const strandOffset = (strandIndex / strands) * Math.PI * 2;
                const theta = Math.PI * t;
                const phi = (t * Math.PI * 2 * 6) + strandOffset; // 6 coils
                
                const x = Math.sin(theta) * Math.cos(phi);
                const y = Math.cos(theta);
                const z = Math.sin(theta) * Math.sin(phi);
                
                this.points.push({
                    x: x, y: y, z: z,
                    theta: theta, phi: phi,
                    amplitude: 0.04 + Math.random() * 0.06,
                    frequency: 0.5 + Math.random() * 1.2,
                    phase: Math.random() * Math.PI * 2,
                    thickness: 0.3 + Math.random() * 0.6
                });
            }
            
            // Create connections
            for (let i = 0; i < this.points.length; i++) {
                for (let j = i + 1; j < this.points.length; j++) {
                    const p1 = this.points[i];
                    const p2 = this.points[j];
                    const phiDiff = Math.abs(p1.phi - p2.phi);
                    const thetaDiff = Math.abs(p1.theta - p2.theta);
                    if ((phiDiff < 0.12 && thetaDiff < 0.25) || 
                        (Math.abs(p1.theta - p2.theta) < 0.08 && phiDiff < 0.4)) {
                        this.lines.push({ p1: p1, p2: p2 });
                    }
                }
            }
        }
        
        updateAndDraw(time, theme) {
            // Update rotation
            this.rotX += this.speedX;
            this.rotY += this.speedY;
            this.rotZ += this.speedZ;
            
            // Project and draw
            for (let line of this.lines) {
                const p1Screen = this.projectPoint(line.p1, time);
                const p2Screen = this.projectPoint(line.p2, time);
                
                if (p1Screen && p2Screen) {
                    ctx.beginPath();
                    const midX = (p1Screen.x + p2Screen.x) / 2;
                    const midY = (p1Screen.y + p2Screen.y) / 2;
                    const offsetX = Math.sin(time * 2 + (line.p1.phi || 0)) * 2;
                    const offsetY = Math.cos(time * 1.5 + (line.p1.theta || 0)) * 2;
                    
                    ctx.moveTo(p1Screen.x, p1Screen.y);
                    ctx.quadraticCurveTo(midX + offsetX, midY + offsetY, p2Screen.x, p2Screen.y);
                    
                    const depthFactor = (p1Screen.z + 1) / 2;
                    const opacity = theme === 'dark' ? 0.3 : 0.15;
                    ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity * (0.4 + depthFactor * 0.6)})`;
                    ctx.lineWidth = (line.p1.thickness || 0.5) * (0.5 + depthFactor * 0.8);
                    ctx.stroke();
                }
            }
            
            // Draw points
            for (let point of this.points) {
                const screen = this.projectPoint(point, time);
                if (screen) {
                    ctx.beginPath();
                    const depth = (screen.z + 1) / 2;
                    const radius = 1.2 * (0.5 + depth * 0.8);
                    ctx.arc(screen.x, screen.y, radius, 0, Math.PI * 2);
                    const glowIntensity = theme === 'dark' ? 0.5 : 0.25;
                    ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${glowIntensity * (0.3 + depth * 0.5)})`;
                    ctx.fill();
                }
            }
        }
        
        projectPoint(point, time) {
            const oscillation = Math.sin(time * point.frequency + point.phase) * point.amplitude;
            let x = point.x;
            let y = point.y;
            let z = point.z;
            
            const radial = 1 + oscillation;
            x *= radial;
            y *= radial;
            z *= radial;
            
            // Apply rotations
            let x1 = x * Math.cos(this.rotY) + z * Math.sin(this.rotY);
            let z1 = -x * Math.sin(this.rotY) + z * Math.cos(this.rotY);
            let y1 = y;
            
            let y2 = y1 * Math.cos(this.rotX) - z1 * Math.sin(this.rotX);
            let z2 = y1 * Math.sin(this.rotX) + z1 * Math.cos(this.rotX);
            let x2 = x1;
            
            let x3 = x2 * Math.cos(this.rotZ) - y2 * Math.sin(this.rotZ);
            let y3 = x2 * Math.sin(this.rotZ) + y2 * Math.cos(this.rotZ);
            
            const scale = this.radius;
            return {
                x: this.centerX + x3 * scale,
                y: this.centerY + y3 * scale,
                z: z2
            };
        }
    }
    
    class RotatingRing {
        constructor(centerX, centerY, radius, speed, color, tilt = 0) {
            this.centerX = centerX;
            this.centerY = centerY;
            this.radius = radius;
            this.speed = speed;
            this.color = color;
            this.tilt = tilt;
            this.angle = 0;
            this.points = [];
            this.initPoints(120);
        }
        
        initPoints(count) {
            for (let i = 0; i < count; i++) {
                const t = (i / count) * Math.PI * 2;
                this.points.push({
                    angle: t,
                    x: Math.cos(t),
                    y: Math.sin(t) * Math.cos(this.tilt),
                    z: Math.sin(t) * Math.sin(this.tilt)
                });
            }
        }
        
        updateAndDraw(time, theme) {
            this.angle += this.speed;
            
            for (let i = 0; i < this.points.length; i++) {
                const p1 = this.points[i];
                const p2 = this.points[(i + 1) % this.points.length];
                
                const x1 = p1.x * Math.cos(this.angle) - p1.z * Math.sin(this.angle);
                const z1 = p1.x * Math.sin(this.angle) + p1.z * Math.cos(this.angle);
                const y1 = p1.y;
                
                const x2 = p2.x * Math.cos(this.angle) - p2.z * Math.sin(this.angle);
                const z2 = p2.x * Math.sin(this.angle) + p2.z * Math.cos(this.angle);
                const y2 = p2.y;
                
                const screenX1 = this.centerX + x1 * this.radius;
                const screenY1 = this.centerY + y1 * this.radius;
                const screenX2 = this.centerX + x2 * this.radius;
                const screenY2 = this.centerY + y2 * this.radius;
                
                ctx.beginPath();
                ctx.moveTo(screenX1, screenY1);
                ctx.lineTo(screenX2, screenY2);
                const opacity = theme === 'dark' ? 0.35 : 0.15;
                ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity})`;
                ctx.lineWidth = 1;
                ctx.stroke();
            }
        }
    }
    
    class RotatingCube {
        constructor(centerX, centerY, size, speedX, speedY, color) {
            this.centerX = centerX;
            this.centerY = centerY;
            this.size = size;
            this.speedX = speedX;
            this.speedY = speedY;
            this.color = color;
            this.rotX = 0;
            this.rotY = 0;
            this.vertices = [];
            this.edges = [];
            this.initCube();
        }
        
        initCube() {
            const s = this.size;
            this.vertices = [
                {x: -s, y: -s, z: -s}, {x:  s, y: -s, z: -s},
                {x:  s, y: -s, z:  s}, {x: -s, y: -s, z:  s},
                {x: -s, y:  s, z: -s}, {x:  s, y:  s, z: -s},
                {x:  s, y:  s, z:  s}, {x: -s, y:  s, z:  s}
            ];
            this.edges = [
                [0,1], [1,2], [2,3], [3,0],
                [4,5], [5,6], [6,7], [7,4],
                [0,4], [1,5], [2,6], [3,7]
            ];
        }
        
        updateAndDraw(theme) {
            this.rotX += this.speedX;
            this.rotY += this.speedY;
            
            const projected = this.vertices.map(v => {
                // Rotate X
                let y1 = v.y * Math.cos(this.rotX) - v.z * Math.sin(this.rotX);
                let z1 = v.y * Math.sin(this.rotX) + v.z * Math.cos(this.rotX);
                let x1 = v.x;
                // Rotate Y
                let x2 = x1 * Math.cos(this.rotY) + z1 * Math.sin(this.rotY);
                let z2 = -x1 * Math.sin(this.rotY) + z1 * Math.cos(this.rotY);
                let y2 = y1;
                return {
                    x: this.centerX + x2,
                    y: this.centerY + y2,
                    z: z2
                };
            });
            
            for (let edge of this.edges) {
                const p1 = projected[edge[0]];
                const p2 = projected[edge[1]];
                ctx.beginPath();
                ctx.moveTo(p1.x, p1.y);
                ctx.lineTo(p2.x, p2.y);
                const opacity = theme === 'dark' ? 0.4 : 0.2;
                ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity})`;
                ctx.lineWidth = 1.2;
                ctx.stroke();
            }
        }
    }
    
    class ParticleField {
        constructor(count) {
            this.particles = [];
            for (let i = 0; i < count; i++) {
                this.particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: (Math.random() - 0.5) * 0.5,
                    vy: (Math.random() - 0.5) * 0.5,
                    size: 1 + Math.random() * 2,
                    color: {r: 164, g: 96, b: 191}
                });
            }
        }
        
        updateAndDraw(theme) {
            for (let p of this.particles) {
                p.x += p.vx;
                p.y += p.vy;
                
                if (p.x < 0) p.x = width;
                if (p.x > width) p.x = 0;
                if (p.y < 0) p.y = height;
                if (p.y > height) p.y = 0;
                
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                const opacity = theme === 'dark' ? 0.3 : 0.15;
                ctx.fillStyle = `rgba(164, 96, 191, ${opacity})`;
                ctx.fill();
            }
        }
        
        resize() {
            for (let p of this.particles) {
                p.x = Math.random() * width;
                p.y = Math.random() * height;
            }
        }
    }
    
    let particleField;
    let currentTheme = 'dark';
    
    function initScene() {
        spheres = [];
        rotatingShapes = [];
        
        // Main center sphere (largest)
        spheres.push(new RotatingSphere(
            width / 2, height / 2, 320,
            0.002, 0.003, 0.0015,
            {r: 164, g: 96, b: 191}, 400
        ));
        
        // Secondary sphere - top left
        spheres.push(new RotatingSphere(
            width * 0.2, height * 0.25, 150,
            0.003, 0.002, 0.004,
            {r: 170, g: 171, b: 220}, 200
        ));
        
        // Secondary sphere - bottom right
        spheres.push(new RotatingSphere(
            width * 0.8, height * 0.7, 180,
            0.0025, 0.0035, 0.002,
            {r: 200, g: 150, b: 220}, 250
        ));
        
        // Small sphere - top right
        spheres.push(new RotatingSphere(
            width * 0.85, height * 0.2, 100,
            0.004, 0.003, 0.005,
            {r: 180, g: 120, b: 200}, 150
        ));
        
        // Small sphere - bottom left
        spheres.push(new RotatingSphere(
            width * 0.15, height * 0.8, 120,
            0.0035, 0.0025, 0.003,
            {r: 150, g: 100, b: 180}, 180
        ));
        
        spheres.push(new RotatingSphere(
            width * 0.75, height * 0.45, 80,
            0.005, 0.004, 0.003,
            {r: 190, g: 130, b: 210}, 120
        ));
        
        // Rotating rings
        rotatingShapes.push(new RotatingRing(
            width / 2, height / 2, 380, 0.004,
            {r: 164, g: 96, b: 191}, Math.PI / 3
        ));
        rotatingShapes.push(new RotatingRing(
            width / 2, height / 2, 400, -0.003,
            {r: 170, g: 171, b: 220}, Math.PI / 4
        ));
        rotatingShapes.push(new RotatingRing(
            width * 0.25, height * 0.3, 120, 0.005,
            {r: 180, g: 120, b: 200}, Math.PI / 2
        ));
        rotatingShapes.push(new RotatingRing(
            width * 0.75, height * 0.7, 140, -0.004,
            {r: 200, g: 150, b: 220}, Math.PI / 5
        ));
        
        // Rotating cubes
        rotatingShapes.push(new RotatingCube(
            width * 0.3, height * 0.6, 60, 0.003, 0.005,
            {r: 164, g: 96, b: 191}
        ));
        rotatingShapes.push(new RotatingCube(
            width * 0.7, height * 0.35, 50, -0.004, 0.003,
            {r: 170, g: 171, b: 220}
        ));
        rotatingShapes.push(new RotatingCube(
            width * 0.5, height * 0.8, 45, 0.005, -0.003,
            {r: 190, g: 130, b: 210}
        ));
        
        // Particle field
        particleField = new ParticleField(200);
    }
    
    const themeObserver = new MutationObserver(() => {
        currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
    });
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
    
    let time = 0;
    
    function drawScene() {
        if (!ctx) return;
        ctx.clearRect(0, 0, width, height);
        
        const gradient = ctx.createLinearGradient(0, 0, width, height);
        if (currentTheme === 'dark') {
            gradient.addColorStop(0, 'rgba(10, 10, 15, 0.98)');
            gradient.addColorStop(0.5, 'rgba(20, 12, 30, 0.98)');
            gradient.addColorStop(1, 'rgba(15, 8, 25, 0.98)');
        } else {
            gradient.addColorStop(0, 'rgba(245, 240, 255, 0.98)');
            gradient.addColorStop(0.5, 'rgba(235, 225, 250, 0.98)');
            gradient.addColorStop(1, 'rgba(240, 230, 255, 0.98)');
        }
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
        
        for (let i = 0; i < spheres.length; i++) {
            for (let j = i + 1; j < spheres.length; j++) {
                const dx = spheres[i].centerX - spheres[j].centerX;
                const dy = spheres[i].centerY - spheres[j].centerY;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 400) {
                    ctx.beginPath();
                    ctx.moveTo(spheres[i].centerX, spheres[i].centerY);
                    const midX = (spheres[i].centerX + spheres[j].centerX) / 2;
                    const midY = (spheres[i].centerY + spheres[j].centerY) / 2;
                    const waveX = Math.sin(time * 2 + dist * 0.02) * 10;
                    const waveY = Math.cos(time * 1.8 + dist * 0.015) * 10;
                    ctx.quadraticCurveTo(midX + waveX, midY + waveY, spheres[j].centerX, spheres[j].centerY);
                    const opacity = currentTheme === 'dark' ? 0.15 : 0.08;
                    ctx.strokeStyle = `rgba(164, 96, 191, ${opacity})`;
                    ctx.lineWidth = 0.8;
                    ctx.stroke();
                }
            }
        }
        
        // rotating shapes
        for (let shape of rotatingShapes) {
            if (shape.updateAndDraw) {
                shape.updateAndDraw(currentTheme);
            }
        }
        
        // spheres
        for (let sphere of spheres) {
            sphere.updateAndDraw(time, currentTheme);
        }
        
        // particle field
        if (particleField) {
            particleField.updateAndDraw(currentTheme);
        }
        
        time += 0.02;
        requestAnimationFrame(drawScene);
    }
    
    window.addEventListener('resize', () => {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
        
        // sphere positions
        if (spheres.length) {
            spheres[0].centerX = width / 2;
            spheres[0].centerY = height / 2;
            spheres[1].centerX = width * 0.2;
            spheres[1].centerY = height * 0.25;
            spheres[2].centerX = width * 0.8;
            spheres[2].centerY = height * 0.7;
            spheres[3].centerX = width * 0.85;
            spheres[3].centerY = height * 0.2;
            spheres[4].centerX = width * 0.15;
            spheres[4].centerY = height * 0.8;
            spheres[5].centerX = width * 0.75;
            spheres[5].centerY = height * 0.45;
            
            // ring positions
            rotatingShapes[0].centerX = width / 2;
            rotatingShapes[0].centerY = height / 2;
            rotatingShapes[1].centerX = width / 2;
            rotatingShapes[1].centerY = height / 2;
            rotatingShapes[2].centerX = width * 0.25;
            rotatingShapes[2].centerY = height * 0.3;
            rotatingShapes[3].centerX = width * 0.75;
            rotatingShapes[3].centerY = height * 0.7;
            
            // cube positions
            rotatingShapes[4].centerX = width * 0.3;
            rotatingShapes[4].centerY = height * 0.6;
            rotatingShapes[5].centerX = width * 0.7;
            rotatingShapes[5].centerY = height * 0.35;
            rotatingShapes[6].centerX = width * 0.5;
            rotatingShapes[6].centerY = height * 0.8;
        }
        
        if (particleField) particleField.resize();
    });

    currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
    
    resizeCanvas();
    drawScene();
})();