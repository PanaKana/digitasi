<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nip, $password)
    {
         $this->getNama = $nama;
         $this->getNip = $nip;
         $this->getPassword = $password;
         // dd($this->getNama);
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->nama);
     return $this->from('Sidare@Poliban.ac.id')
                   ->view('admin.userbaru')
                   ->with(
                    [
                        'nama' => $this->getNama,
                        'nip' =>  $this->getNip,
                        'password' => $this->getPassword,
                    ]);
    }
}
