<?php

namespace Apibuf\Descriptor;

use Exception;
use InvalidArgumentException;
use ProtoReflection\Parser;

class ProtobufDescriptorReader
{
    /**
     * @throws Exception
     */
    public function read(string $input): ProtobufDescription
    {
        if (!file_exists($input)) {
            throw new InvalidArgumentException("File $input not found");
        }

        $data = file_get_contents($input);
        $parser = new Parser($data);
        $fileDescription = $parser->parse();

        var_export($fileDescription);

        return new ProtobufDescription();
    }
}