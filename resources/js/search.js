import React from "react";
import {createRoot} from "react-dom/client";
import {HashRouter,Routes,Route} from "react-router-dom";
import Search from "./Home/Search";



const MainRouter = ()=> {
   return(
       <HashRouter>
           <Routes>
               <Route path={'/'} element={<Search  />} />
           </Routes>
       </HashRouter>
   )

}

const root = document.getElementById('root')
createRoot(root).render(<MainRouter/>)
