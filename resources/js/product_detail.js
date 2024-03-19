import React from "react";
import {createRoot} from "react-dom/client";
import {HashRouter,Routes,Route} from "react-router-dom";
import Product_detail from "./Home/Product_detail";


const slug = document.getElementById('root').dataset.slug;
const MainRouter = ()=> {
   return(
       <HashRouter>
           <Routes>
               <Route path={'/'} element={<Product_detail slug={slug} />} />
           </Routes>
       </HashRouter>
   )

}

const root = document.getElementById('root')
createRoot(root).render(<MainRouter/>)
