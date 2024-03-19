import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter,Routes,Route } from "react-router-dom";
import  Product_cart  from "./Home/Product_cart";

const MainRouter = ()=> {
   return (
       <HashRouter>
           <Routes>
               <Route path={"/"} element={<Product_cart/>} />
           </Routes>
       </HashRouter>
   );
}

const root = document.getElementById("root");
createRoot(root).render(<MainRouter />);
