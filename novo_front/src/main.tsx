import React from 'react'
import ReactDOM from 'react-dom/client'
import Painel from './pages/Painel/index'
import  {
  BrowserRouter as Router,
  Routes,
  Route,
  Link
} from "react-router-dom"



ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    
  <Painel/>    

  </React.StrictMode>
)
