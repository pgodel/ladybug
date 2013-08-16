<?php
/*
 * Ladybug: Simple and Extensible PHP Dumper
 *
 * Mysql/Link dumper
 *
 * (c) Raúl Fraile Beneyto <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ladybug\Inspector\Resource;

use Ladybug\Inspector\AbstractInspector;
use Ladybug\Inspector\InspectorInterface;
use Ladybug\Type;

class MysqlLink extends AbstractInspector
{
    public function accept($var, $type = InspectorInterface::TYPE_CLASS)
    {
        return InspectorInterface::TYPE_RESOURCE == $type && is_resource($var) && 'mysql link' === get_resource_type($var);
    }

    public function getData($var, $type = InspectorInterface::TYPE_CLASS)
    {
        if (!$this->accept($var, $type)) {
            throw new \Ladybug\Exception\InvalidInspectorClassException();
        }

        $collection = Type\Extended\CollectionType::create(array(
            Type\Extended\TextType::create(mysql_get_host_info($var), 'Host info', $this->level + 1),
            Type\Extended\TextType::create(mysql_get_proto_info($var), 'Protocol version', $this->level + 1),
            Type\Extended\TextType::create(mysql_get_server_info($var), 'Server version', $this->level + 1)
        ));

        $collection->setTitle('MySQL connection');
        $collection->setLevel($this->level);

        return $collection;
    }
}
