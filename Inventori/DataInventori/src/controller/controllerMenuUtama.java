/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package controller;

import view.FormBarang;
import view.FormLupa;
import view.FormPegawai;
import view.MenuUtama;

/**
 *
 * @author USER
 */
public class controllerMenuUtama {
    MenuUtama frame;
    FormBarang fBarang;
    FormPegawai fPegawai;
    FormLupa fLupaPass;
  
    
    public controllerMenuUtama(MenuUtama frame) {
        this.frame = frame;
    }
    
    public void masukFormBarang() {
        fBarang = new FormBarang();
        fBarang.setVisible(true);
    }
    
    public void masukFormPegawai() {
        fPegawai = new FormPegawai();
        fPegawai.setVisible(true);
    }
    
    public void masukFormLupaPass() {
        fLupaPass = new FormLupa();
        fLupaPass.setVisible(true);
    }
    
    public void keluar() {
        frame.dispose();
    }
}
