<xsl:stylesheet
        version="2.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:ctboost="http://yii-booster.clevertech.biz/UserDocumentationSchema"
        exclude-result-prefixes="ctboost">

    <xsl:function name="ctboost:makeSectionId">
        <xsl:param name="sectionName" />
        <xsl:value-of select="replace(normalize-space(replace(lower-case($sectionName), '[^a-zA-Z0-9]', ' ')), ' ', '-')" />
    </xsl:function>
    <xsl:function name="ctboost:makeWidgetCode">
        <xsl:param name="widgetClassName" />
        <xsl:value-of select="replace(lower-case($widgetClassName), '^tb', '')" />
    </xsl:function>
    <xsl:function name="ctboost:ucfirst">
        <xsl:param name="word" />
        <xsl:value-of select="concat(upper-case(substring($word,1,1)),
          substring($word, 2),
          ' '[not(last())])" />
    </xsl:function>

    <xsl:variable name="widgetname" select="documentation/@for" />
    <xsl:variable name="widgetcode" select="ctboost:makeWidgetCode($widgetname)" />

    <xsl:template match="/">
        <xsl:processing-instruction name="php">
            <xsl:text>
/**
 * End-user documentation for </xsl:text>
            <xsl:value-of select="$widgetname" />
            <xsl:text> widget.
 *
 * @var WidgetsController $this
 */

$this->header = '</xsl:text>
            <xsl:value-of select="$widgetname" />
            <xsl:text>';
$this->subheader = '</xsl:text>
            <xsl:value-of select="documentation/@punchline" />
            <xsl:text>';

$this->menu = array(</xsl:text>
            <xsl:for-each select="//section">
                <xsl:variable name="sectionid" select="ctboost:makeSectionId(@named)" />

                <xsl:text>
    '</xsl:text>
                <xsl:value-of select="$sectionid" />
                <xsl:text>' => '</xsl:text>
                <xsl:value-of select="@named" />
                <xsl:text>',</xsl:text>

            </xsl:for-each>
            <xsl:text>
);
</xsl:text>
        </xsl:processing-instruction>

        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="section">
        <section>
            <xsl:attribute name="id">
                <xsl:value-of select="ctboost:makeSectionId(@named)" />
            </xsl:attribute>

            <div class="page-header">
                <h1><xsl:value-of select="@named" /></h1>
            </div>

            <xsl:apply-templates />
        </section>

    </xsl:template>

    <xsl:template match="example">
        <xsl:processing-instruction name="php">
            <xsl:text>$this->widget('Example', array('name' => '</xsl:text>
            <xsl:value-of select="$widgetcode" />
            <xsl:text>.</xsl:text>
            <xsl:value-of select="@name" />
            <xsl:text>'));</xsl:text>
        </xsl:processing-instruction>
    </xsl:template>

    <xsl:template match="p">
        <p><xsl:apply-templates /></p>
    </xsl:template>

    <xsl:template match="p[@label]">
        <p>
            <span>
                <xsl:attribute name="class">
                    <xsl:text>label label-</xsl:text>
                    <xsl:value-of select="@label" />
                </xsl:attribute>
                <xsl:value-of select="ctboost:ucfirst(@label)" />
            </span>
            <xsl:apply-templates />
        </p>
    </xsl:template>

    <xsl:template match="ln">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

    <xsl:template match="wn">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

    <xsl:template match="pn">
        <code><xsl:value-of select="." /></code>
    </xsl:template>

</xsl:stylesheet>