import React from "react";
import {createRoot} from "react-dom/client";
import {HashRouter,Routes,Route} from "react-router-dom";
import Transaction from "./Home/Transaction";



const MainRouter = ()=> {
   return(
       <HashRouter>
           <Routes>
               <Route path={'/'} element={<Transaction  />} />
           </Routes>
       </HashRouter>
   )

}

const root = document.getElementById('root')
createRoot(root).render(<MainRouter/>)
