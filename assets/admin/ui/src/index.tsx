import { createRoot } from 'react-dom/client';
import App from './App'
import ThemeProvider from "./Theme"

document.addEventListener('DOMContentLoaded', ()=> {
  // @ts-ignore
  const root = createRoot(document.getElementById('app'));
  // @ts-ignore
  root.render(<ThemeProvider><App /></ThemeProvider>);
})
