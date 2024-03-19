import React from "react";
import {createRoot} from "react-dom/client";
import { HashRouter ,Routes, Route } from "react-router-dom";
import Home from "./Home/Home";

const  MainRouter = () =>{
    return (
        <HashRouter>
            <Routes>
                <Route path="/" element={<Home/>} />
            </Routes>
        </HashRouter>
    );
}
const el = document.getElementById('root');
createRoot(el).render(<MainRouter/>);
