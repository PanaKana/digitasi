<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SidareEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $naming, $nosurat)
    {
         $this->getNama = $naming['0'];
         $this->getNomor = $nosurat;
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
                   ->view('admin.kirimemail')
                   ->with(
                    [
                        'nama' => $this->getNama,
                        'nosurat' => $this->getNomor,
                                            ]);
    }
}
