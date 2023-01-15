import React from 'react'
import ReactDOM from 'react-dom/client'
import Painel from './pages/Painel/index'
import  {
  BrowserRouter as Router,
  Routes,
  Route,
  Link
} from "react-router-dom"
import SignUp from './pages/SignUp/SignUp'



ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    
  <SignUp/>    

  </React.StrictMode>
)
