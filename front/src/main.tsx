import ReactDOM from 'react-dom/client'
import { App } from './App.tsx'
import { StrictMode } from 'react'

import './styles/global.css'
import Navbar from '@/components/Layout/Navbar.tsx'

ReactDOM.createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <Navbar />

    <div className="bg-gray-100 pt-10 pb-10 container mx-auto px-4">
      <App />
    </div>
  </StrictMode>,
)
