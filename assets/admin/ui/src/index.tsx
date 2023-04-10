import { createRoot } from 'react-dom/client';

// Clear the existing HTML content
document.body.innerHTML = '<div id="app"></div>';

// Render your React component instead
// @ts-ignore
const root = createRoot(document.getElementById('app'))

// @ts-ignore
root.render(<h1>Hello, world</h1>);
